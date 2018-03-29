<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Setting;
use SumanIon\CloudFlare;
use App\Traits\LogTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SigninRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class SigninController extends Controller{

    use ThrottlesLogins , LogTrait;

    public function __construct(){
        $this->middleware('guest');
    }

    public function getSignin(){
        return view('auth.signin');
    }

    public function sendLockoutResponse(Request $request){
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        $message = Lang::get('auth.signin.limit', ['seconds' => $seconds]);

        return redirect()->back()->with('error', $message);
    }

    public function postSignin(SigninRequest $request){

        if (Setting::get('signin_disabled')) {
            return redirect()->back();
        }

        if ($this->hasTooManyLoginAttempts($request)) {
            $request->session()->put('signincaptcha', 1);

            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

         if (Auth::attempt($request->only($this->username(), 'password'), $request->has('remember'))) {

            if (!Auth::user()->active) {
                Auth::logout();
                
                return redirect()->back()->with('error', Lang::get('auth.signin.notactivate'));
            }

            if (Auth::user()->ban) {
                Auth::logout();
                
                return redirect()->back()->with('error', Lang::get('auth.signin.banned'));
            }

            $request->session()->forget('signincaptcha');
            
            $request->session()->regenerate();

            $this->clearLoginAttempts($request);

            $this->LogFile('auth', 'Zalogowano na konto', [
                'user_id' => Auth::user()->id,
                'ip' => Cloudflare::ip(),
            ]);

            
            return redirect()->route('dashboard');
        }

        $this->incrementLoginAttempts($request);

        return redirect()->back()->with('error', Lang::get('auth.signin.failed'));

    }

    public function username(){
        return 'email';
    }

}
