<?php

namespace App\Http\Controllers\Admin;

use Mail;
use App\Payout;
use App\Referral;
use App\User;
use SumanIon\CloudFlare;
use Carbon\Carbon;
use App\Traits\LogTrait;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Withdraw\CancelRequest;
use Illuminate\Support\Facades\Lang;
use App\Http\Controllers\Controller;

class WithdrawController extends Controller{

    use LogTrait;

    public function getWithdraw(){

    	$today = Carbon::today()->toDateString();

    	$withdraws = Payout::orderby('id', 'desc')->paginate(15);
    	$withdrawsWait = Payout::wait();
    	$withdrawsNotConfirm = Payout::notconfirm();
    	$withdrawsPayToday = Payout::pay()->where('paid_at', '>=', $today);
    	$withdrawSum = Payout::pay()->sum('amount');

        return view('admin.withdraw.list', [
            'withdraws' => $withdraws,
            'withdrawsWait' => $withdrawsWait,
            'withdrawsNotConfirm' => $withdrawsNotConfirm,
            'withdrawsPayToday' => $withdrawsPayToday,
            'withdrawSum' => $withdrawSum,
        ]);

    }

    public function getWithdrawDetail($id){

    	$withdraw = Payout::where('id', $id)->first();

    	if (!$withdraw){
            alert()->error('Taka wypłata nie istnieje w bazie!', 'Wypłata nie istnieje!');

            return redirect()->route('admin.withdraw.list');
        }

		return view('admin.withdraw.detail', [
		    'withdraw' => $withdraw,
		]);

    }

    public function postWithdrawConfirm($id){

    	$withdraw = Payout::where('id', $id)->first();

    	if (!$withdraw) return redirect()->back()->with('error','W bazie nie istnieje wypłata o takim identyfikatorze!');

    	if ($withdraw->status == 'cancel') return redirect()->back()->with('error','Nie możesz zrealizować wypłaty, ponieważ została ona wcześniej anulowana!');

    	if ($withdraw->status == 'notconfirm') return redirect()->back()->with('error','Nie możesz zrealizować wypłaty, ponieważ nie została potwierdzona przez użytkownika!');

    	$pay = $withdraw->status == 'pay' ? 'wait' : 'pay';
    	$paid_at = $withdraw->status == 'pay' ? NULL : Carbon::now();

        if ($withdraw->status == 'wait') {
            if ($withdraw->user->referral) {
                $user = User::where('id', $withdraw->user->referral)->first();
                $referral = Referral::where('payout_id', $withdraw->id)->first();
                    if ($user && !$referral) {
                        $balance = $user->balance;
                        $amount = number_format(($user->referral_provision*$withdraw->amount)/100, 2, '.', '');;
                        Referral::create([
                            'referral_id' => $withdraw->user->referral,
                            'user_id' => $withdraw->user_id,
                            'payout_id' => $withdraw->id,
                            'amount' => $amount,
                        ]);

                        $user->update([
                            'balance' => $user->balance + $amount,
                        ]);

                        $this->LogFile('admin', 'Dodano prowizję od wypłaty poleconego', [
                            'referral_id' => $withdraw->user->referral,
                            'user_id' => $withdraw->user_id,
                            'payout_id' => $withdraw->id,
                            'before_balance' => $balance,
                            'amount' => $amount,
                            'after_balance' => $user->balance,
                            'ip' => Cloudflare::ip(),
                        ]);
                    }
            }
        }elseif($withdraw->status == 'pay'){
            $referral = Referral::where('payout_id', $withdraw->id)->first();
                if ($referral) {
                    $user = User::where('id', $referral->referral_id)->first();
                        if ($user) {
                            $balance = $user->balance;
                            
                            $user->update([
                                'balance' => $user->balance - $referral->amount,
                            ]);

                            $referral->delete();

                            $this->LogFile('admin', 'Usunięto prowizję od wypłaty poleconego', [
                                'referral_id' => $withdraw->user->referral,
                                'user_id' => $withdraw->user_id,
                                'payout_id' => $withdraw->id,
                                'before_balance' => $balance,
                                'amount' => $referral->amount,
                                'after_balance' => $user->balance,
                                'ip' => Cloudflare::ip(),
                            ]);
                        }
                }
        }
    	
		$update = $withdraw->update([
			'status' => $pay,
			'paid_at' => $paid_at,
		]);

        $this->LogFile('admin', 'Zmieniono status wypłaty', [
            'payout_id' => $withdraw->id,
            'status' => $withdraw->status,
            'ip' => Cloudflare::ip(),
        ]);

		if ($update) return redirect()->back()->with('success','Status wypłaty został zmieniony pomyślnie!');

		return redirect()->back()->with('error','Wystąpił nieoczekiwany błąd! Spróbuj ponownie za chwilę.');

    }

    public function postWithdrawCancel($id, CancelRequest $request){

    	$withdraw = Payout::where('id', $id)->first();

    	if (!$withdraw) return redirect()->back()->with('error','W bazie nie istnieje wypłata o takim identyfikatorze!');

    	if ($withdraw->status == 'cancel') return redirect()->back()->with('error','Nie możesz anulować wypłaty ponieważ została już wcześniej anulowana!');

        if ($withdraw->status == 'pay') return redirect()->back()->with('error','Nie możesz anulować wypłaty ponieważ została zrealizowana!');

        $balance = $withdraw->user->balance;

    	$update = $withdraw->user()->update([
    		'balance' => $withdraw->user->balance + $withdraw->amount,
    	]);

    	if ($update) {
	    	
	    	$withdraw->update([
				'status' => 'cancel',
				'cancel_reason' => trim($request->get('cancel_reason')),
			]);

            $this->LogFile('admin', 'Anulowano wypłatę środków', [
                'payout_id' => $withdraw->id,
                'reason' => $withdraw->cancel_reason,
                'status' => $withdraw->status,
                'before_balance' => $balance,
                'amount' =>  $withdraw->amount,
                'ip' => Cloudflare::ip(),
            ]);

			return redirect()->back()->with('success','Wypłata środków została anulowana pomyślnie!');
    	}

		return redirect()->back()->with('error','Wystąpił nieoczekiwany błąd! Spróbuj ponownie za chwilę.');

    }

    public function postWithdrawResend($id){

    	$withdraw = Payout::where('id', $id)->first();

    	if (!$withdraw) return redirect()->back()->with('error','W bazie nie istnieje wypłata o takim identyfikatorze!');

    	if ($withdraw->status == 'cancel') return redirect()->back()->with('error','Nie możesz wysłać potwierdzenia jeszcze raz ponieważ wypłata została anulowana!');

        if ($withdraw->status == 'pay') return redirect()->back()->with('error','Nie możesz wysłać potwierdzenia jeszcze raz ponieważ wypłata została zrealizowana!');
		
        Mail::send('emails.withdrawconfirm', [
            'username' => $withdraw->user->username, 
            'withdraw_amount' => $withdraw->amount, 
            'withdraw_form' => $withdraw->form, 
            'withdraw_priority' => $withdraw->priority,
            'bank_account' => $withdraw->user->profile->bank_account, 
            'paypal' => $withdraw->user->profile->paypal, 
            'token' => $withdraw->token
        ], function ($message) use ($withdraw){

            $message->to($withdraw->user->email);
            $message->subject("SMSLeader.pl - Potwierdzenie wypłaty środków");

      	});

		return redirect()->back()->with('success','Wiadomość potwierdzjąca wypłatę została wysłana!');

    }
}
