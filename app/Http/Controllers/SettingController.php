<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Mail;
use Setting;
use SumanIon\CloudFlare;
use Carbon\Carbon;
use App\Traits\LogTrait;
use App\Http\Requests\Setting\AccountRequest;
use App\Http\Requests\Setting\PayoutRequest;
use App\Http\Requests\Setting\PersonalRequest;
use App\Http\Requests\Setting\PasswordRequest;
use Illuminate\Http\Request;

class SettingController extends Controller {

    use LogTrait;

    public function __construct() {
        $this->middleware('auth');
    }

    public function getPersonal() {
        return view('setting.personal');
    }

    public function postPersonal(PersonalRequest $request) {

        $nip = ($request->get('account_type') == 'private') ? Auth::user()->profile->nip : trim($request->get('nip'));
        $company_name = ($request->get('account_type') == 'private') ? Auth::user()->profile->company_name : trim($request->get('company_name'));

        $update = Auth::user()->profile()->update([
            'account_type' => $request->get('account_type'),
            'company_name' => $company_name,
            'nip' => $nip,
            'pesel' => $request->get('pesel'),
            'first_name' => trim($request->get('first_name')),
            'last_name' => trim($request->get('last_name')),
            'address' => trim($request->get('address')),
            'city' => trim($request->get('city')),
            'zip_code' => $request->get('zip_code'),
        ]);

        if ($update) {

            $this->LogFile('setting', 'Zmiana danych osobowych', [
                'user_id' => Auth::user()->id,
                'request' => $request->except(['_token']),
                'ip' => Cloudflare::ip(),
            ]);

            return redirect()->route('setting.personal')->with('success', 'Dane osobowe zostały zapisane pomyślnie.');
        }

        return redirect()->route('setting.personal')->with('error', 'Wystapil nieoczekiwany bląd. Spróbuj ponownie za chwilę! Jeśli problem będzie się powtarzał, skontaktuj się z administratorem!');
    }

    public function getAccount(){

        return view('setting.account');
    }

    public function postAccount(AccountRequest $request){

        $update = Auth::user()->profile()->update([
            'lead_sound' => $request->get('lead_sound'),
            'gg_number' => $request->get('gg_number'),
            'chat_view' => $request->get('chat_view'),
            'rank_view' => $request->get('rank_view'),
        ]);

        if ($update) {

            $this->LogFile('setting', 'Zmiana ustawien konta', [
                'user_id' => Auth::user()->id,
                'request' => $request->except(['_token']),
                'ip' => Cloudflare::ip(),
            ]);

            return redirect()->route('setting.account')->with('success', 'Ustawienia konta zostały zapisane pomyślnie.');
        }

        return redirect()->route('setting.account')->with('error', 'Wystapil nieoczekiwany bląd. Spróbuj ponownie za chwilę! Jeśli problem będzie się powtarzał, skontaktuj się z administratorem!');
    }

    public function getPayout() {

        return view('setting.payout');

    }

    public function postPayout(PayoutRequest $request) {

        $paypal = Setting::get('withdraw_paypal_disabled') ? Auth::user()->profile->paypal : $request->get('paypal');

        $update = Auth::user()->profile()->update([
            'bank_name' => trim($request->get('bank_name')),
            'bank_account' => trim($request->get('bank_account')),
            'paypal' => $paypal,
        ]);

        if ($update) {

            $this->LogFile('setting', 'Zmiana danych do wyplaty', [
                'user_id' => Auth::user()->id,
                'request' => $request->except(['_token']),
                'ip' => Cloudflare::ip(),
            ]);

            return redirect()->route('setting.payout')->with('success', 'Ustawienia wypłaty zostały zapisane pomyślnie.');
        }

        return redirect()->route('setting.payout')->with('error', 'Wystapil nieoczekiwany bląd. Spróbuj ponownie za chwilę! Jeśli problem będzie się powtarzał, skontaktuj się z administratorem!');
    }

    public function getPassword() {
        return view('setting.password');
    }

    public function postPassword(PasswordRequest $request) {

        if (!Hash::check($request->get('old_password'), Auth::user()->password)) {
            return redirect()->route('setting.password')->with('error', 'Wprowadzone przez Ciebie aktualne hasło jest nieprawidłowe!');
        }

        $reset = Auth::user()->reset()->create([
            'password' => bcrypt($request->get('new_password')),
            'token' => str_random(64),
        ]);

        if ($reset) {

            Mail::send('emails.passwordchange', ['username' => Auth::user()->username, 'token' => $reset->token], function ($message){
                $message->to(Auth::user()->email);
                $message->subject("SMSLeader.pl - Potwierdzenie zmiany hasła");
            });

            $this->LogFile('setting', 'Zmiana hasla (1/2)', [
                'user_id' => Auth::user()->id,
                'ip' => Cloudflare::ip(),
            ]);

            return redirect()->route('setting.password')->with('success', 'Proces zmiany hasła przebiega pomyślnie! Na adres email wysłaliśmy wiadomość z linkiem potwierdzającym.');
        }

        return redirect()->route('setting.password')->with('error', 'Wystapil nieoczekiwany bląd. Spróbuj ponownie za chwilę! Jeśli problem będzie się powtarzał, skontaktuj się z administratorem!');
    }

    public function getPasswordChange($token) {
        
        $change = Auth::user()->reset()->where('token', $token)->first();

        if ($change) {

            if ($change->created_at < Carbon::now()->subDay()) {
                $change->delete();

                return redirect()->route('setting.password')->with('error','Przykro nam lecz link potwierdzający zmianę hasła wygasł! Rozpocznij proces zmiany hasła od początku.');
            }

            $update = Auth::user()->update([
                'password' => $change->password,
            ]);

            if ($update) {
                
                $change->delete();

                $this->LogFile('setting', 'Zmiana hasla (2/2)', [
                    'user_id' => Auth::user()->id,
                    'ip' => Cloudflare::ip(),
                ]);

                Auth::logout();

                return redirect()->route('auth.signin')->with('success', 'Hasło zostało zmienione pomyślnie! W celu bezpieczeństwa musisz zalogować się przy użyciu nowego hasła.');
            }

            return redirect()->route('setting.password')->with('error', 'Wystapil nieoczekiwany bląd. Spróbuj ponownie za chwilę! Jeśli problem będzie się powtarzał, skontaktuj się z administratorem!');
        }

        return redirect()->route('setting.password')->with('error', 'Link potwierdzający zmianę hasła jest nieprawidłowy.');

    }

    public function getHistory(){

        $logs = Auth::user()->log()->where('public', true)->newest()->paginate(12);

        return view('setting.history', [
            'logs' => $logs
        ]);
    }
}
