<?php

namespace App\Http\Controllers\Auth;

use Mail;
use App\User;
use Carbon\Carbon;
use App\Traits\LogTrait;
use App\Http\Requests\Auth\PasswordForgotRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

class PasswordForgotController extends Controller{    

    use LogTrait;

    public function __construct(){

        $this->middleware('guest');
    }


    public function getPasswordForgot(){

        return view('auth.passwordforgot');
    }

    public function postPasswordForgot(PasswordForgotRequest $request){

        $user = User::where('username', $request->get('username'))->where('email', $request->get('email'))->first();

        if ($request->session()->get('forgotlimit', 1) > 3) {
            $request->session()->put('forgotcaptcha', 1);
        }

        if ($user) {

            if (!$user->active) {
                return redirect()->route('auth.password.forgot')->with('error', Lang::get('auth.passwordforgot.notactivate'));
            }

            if ($user->ban) {
                return redirect()->route('auth.password.forgot')->with('error', 'konto zbanowane!');
            }

            if ($user->reset_at > Carbon::now()->subMinutes(15)) {
                return redirect()->route('auth.password.forgot')->with('error', Lang::get('auth.passwordforgot.limit'));
            }

            $user->update([
                'reset_token' => str_random(64),
                'reset_at' => Carbon::now(),
            ]);

            Mail::send('emails.passwordforgot', ['user_id' => $user->id, 'username' => $user->username, 'token' => $user->reset_token], function ($message) use ($user)
            {
                $message->to($user->email);
                $message->subject("SMSLeader.pl - Resetowanie hasła");
            });

            $request->session()->forget('forgotlimit');
            $request->session()->forget('forgotcaptcha');

            alert()->success(Lang::get('auth.passwordforgot.success'), 'Resetowanie hasła')->autoclose(2000);
            return redirect()->route('auth.password.forgot');
        }

        $request->session()->put('forgotlimit', $request->session()->get('forgotlimit', 1) + 1);

        return redirect()->route('auth.password.forgot')->with('error', Lang::get('auth.passwordforgot.failed'));
    }
}
