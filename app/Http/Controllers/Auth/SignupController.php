<?php

namespace App\Http\Controllers\Auth;

use Mail;
use Setting;
use App\User;
use SumanIon\CloudFlare;
use App\Traits\LogTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignupRequest;
use Illuminate\Support\Facades\Lang;

class SignupController extends Controller{
    
    use LogTrait;

    public function __construct(){
        
        $this->middleware('guest');
    }

    public function getSignup(){   

        return view('auth.signup');
    }

    public function postSignup(SignupRequest $request){

        if (Setting::get('signup_disabled')) {
            return redirect()->route('auth.signup');
        }

        $referral = $request->cookie('referral') ? $request->cookie('referral') : NULL;

        $user = User::create([
            'username' => $request->get('username'),
            'password' => bcrypt($request->get('password')),
            'email' => $request->get('email'),
            'referral_id' => str_random(10),
            'referral' => $referral,
            'active' => false,
        ]);

        if ($user) {

            $activation = $user->activation()->create([
                'token' => str_random(64),
            ]);

            if ($referral) {
                $user->referral()->create([
                    'referral_id' => $user->referral,
                    'user_id' => $user->id,
                    'amount' => 0,
                ]);
            }

            $user->profile()->create([]);

            $user->tier()->create([]);

            Mail::send('emails.accountactivate', ['user_id' => $user->id, 'username' => $user->username, 'token' => $activation->token], function ($message) use ($user){

                $message->to($user->email);
                $message->subject("SMSLeader.pl - Aktywacja konta");

            });

            $this->LogFile('auth', 'Utworzono nowe konto', [
                'user_id' => $user->id,
                'ip' => Cloudflare::ip(),
            ]);

            $this->LogDB($user->id, 'auth', 'Utworzono konto', Cloudflare::ip());

            alert()->success(Lang::get('auth.signup.success'), 'Pomyślnie zarejestrowano');
            return redirect()->route('auth.signup');
        }

        return redirect()->route('auth.signup')->with('error', Lang::get('auth.signup.failed'));
    }

}
