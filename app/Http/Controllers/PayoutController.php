<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use Setting;
use SumanIon\CloudFlare;
use App\Traits\LogTrait;
use App\Traits\Payout\WithdrawTrait;
use App\Http\Requests\Payout\WithdrawRequest;
use Illuminate\Support\Facades\Lang;

class PayoutController extends Controller{

    use LogTrait, WithdrawTrait;

    public function __construct(){

        $this->middleware('auth');

    }

    public function getHistory(){

        $withdraws = Auth::user()->payout()->newest()->paginate(12);
        $withdrawsNotConfirm = Auth::user()->payout()->notconfirm()->get();
        $withdrawsWait = Auth::user()->payout()->wait()->get();
        $withdrawsPay = Auth::user()->payout()->pay()->sum('amount');

        return view('payout.history', [
            'withdraws' => $withdraws,
            'withdrawsNotConfirm' => $withdrawsNotConfirm,
            'withdrawsWait' =>  $withdrawsWait,
            'withdrawsPay' => $withdrawsPay,
        ]);

    }

    public function getWithdraw(){

        if (Setting::get('withdraw_disabled')) {
            alert()->info('Możliwość wypłaty środków została chwilowo zablokowana przez Administrację!', 'Wypłata środków zablokowana!')->persistent('Zamknij');
        }

        return view('payout.Withdraw', [
            'withdrawBlock' => $this->withdrawBlock(),
        ]);
        
    }

    public function postWithdraw(WithdrawRequest $request){
        
        if (Setting::get('withdraw_disabled')) {
            return redirect()->route('payout.withdraw');
        }

        if ($this->withdrawBlock()) {
            return redirect()->route('payout.withdraw')->with('error', 'Uzupełnij swój profil aby móc dokonywać wypłat! Możesz to zrobić w zakładce: <span class="bold">Ustawienia konta > Dane osobowe</span>');
        }

        if ($request->get('form') == 'paypal' && Setting::get('withdraw_paypal_disabled')) {
            return redirect()->route('payout.withdraw')->with('error', 'Możliwość wypłaty środków poprzez Paypal jest chwilowo niedostępna!');
        }

        if ($request->get('form') == 'bank' && !Auth::user()->profile->bank_account && !Auth::user()->profile->bank_name) {
          return redirect()->route('payout.withdraw')->with('error', 'Forma wypłaty nie została ustawiona! Przejdź do zakładki <span class="bold">Ustawienia konta > Ustawienia wypaty</span> w celu zdefiniowania formy wypłaty.');
        }

        if ($request->get('form') == 'paypal' && !Auth::user()->profile->paypal) {
          return redirect()->route('payout.withdraw')->with('error', 'Forma wypłaty nie została ustawiona! Przejdź do zakładki <span class="bold">Ustawienia konta > Ustawienia wypaty</span> w celu zdefiniowania formy wypłaty.');
        }

        if ($request->get('priority') == 'express' && Setting::get('withdraw_express_disabled')) {
            return redirect()->route('payout.withdraw')->with('error', 'Możliwość wypłaty ekspresowej została tymczasowo zablokowana!');
        }

        $balance = Auth::user()->balance;

        $user = Auth::user()->update([
            'balance' => Auth::user()->balance - $request->get('amount'),
        ]);

        if ($user) {

            if ($request->get('priority') == 'express'){
                $priority_provision = ($request->get('amount')*Setting::get('withdraw_express_provision'))/100;
                $amount = $request->get('amount') - $priority_provision;
            }

            if ($request->get('priority') == 'standard'){
                $priority_provision = 0;
                $amount = $request->get('amount');
            }

            $payout = Auth::user()->payout()->create([
                'payout_id' => $this->withdrawID(),
                'amount' => $amount,
                'priority' => $request->get('priority'),
                'priority_provision' => $priority_provision,
                'form' => $request->get('form'),
                'token' => str_random(64),
            ]);

            $this->LogFile('withdraw', 'Wyplata srodkow', [
                'user_id' => Auth::user()->id,
                'payout_id' => $payout->id,
                'before_balance' => $balance,
                'amount' => $payout->amount,
                'provision' => $payout->priority_provision,
                'after_balance' => Auth::user()->balance,
                'form' => $request->get('form'),
                'priority' => $request->get('priority'),
                'token' => $payout->token,
                'ip' => Cloudflare::ip(),
            ]);

            Auth::user()->log()->create([
                'type' => 'withdraw',
                'event' => 'Zlecono wypłatę środków: '. $payout->amount .' PLN',
                'event_id' => $payout->id,
                'ip_address' => Cloudflare::ip(),
            ]);

            Mail::send('emails.payout.withdrawconfirm', ['username' => Auth::user()->username, 'amount' => $payout->amount, 'form' => $payout->form, 'priority' => $payout->priority, 'bank_account' => Auth::user()->profile->bank_account, 'paypal' => Auth::user()->profile->paypal, 'token' => $payout->token], function ($message){

                $message->to(Auth::user()->email);
                $message->subject("SMSLeader.pl - Potwierdzenie wypłaty środków");

          });

          return redirect()->route('payout.withdraw')->with('success', 'Wypłata środków przebiega pomyślnie! Na adres email wysłaliśmy wiadomość z linkiem potwierdzającym wypłatę.');

        }

        return redirect()->route('payout.withdraw')->with('error', 'Wystapil nieoczekiwany bląd. Spróbuj ponownie za chwilę! Jeśli problem będzie się powtarzał, skontaktuj się z administratorem!');
    }

    public function getWithdrawConfirm($token){

        $payout = Auth::user()->payout()->where('token', $token)->first();

        if ($payout) {

            if ($payout->status == 'cancel'){
                
                $payout->update([
                    'token' => NULL,
                ]);

                alert()->error('Administrator anulował wypłatę! Sprawdź powód w historii wypłat.', 'Anulowano wypłatę!');

                return redirect()->route('payout.history');
            }

            $payout->update([
                'status' => 'wait',
                'token' => NULL,
            ]);

            $this->LogFile('withdraw', 'Potwierdzono wyplate srodkow', [
                'user_id' => Auth::user()->id,
                'payout_id' => $payout->id,
                'token' => $token,
                'ip' => Cloudflare::ip(),
            ]);

            Auth::user()->log()->create([
                'type' => 'withdraw',
                'event' => 'Potwierdzono wypłatę środków nr. '.$payout->payout_id,
                'event_id' => $payout->id,
                'ip_address' => Cloudflare::ip(),
                'public' => false,
            ]);
          
            alert()->success('Dziękujemy za potwierdzenie wypłaty środków. Oczekuj na realizację wypłaty przez Administrację.', 'Wypłata potwierdzona!');

            return redirect()->route('payout.history');
        }

        alert()->error('Wypłata została już potwierdzona lub link jest nieprawidłowy!', 'Wystąpił błąd!');

        return redirect()->route('payout.history');
    }
}
