<?php

namespace App\Http\Controllers\Auth;

use Mail;
use App\User;
use App\Traits\LogTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

class PasswordResetController extends Controller{
    
    use LogTrait;

    public function __construct(){

        $this->middleware('guest');
    }


    public function getPasswordReset($user_id, $token){
        
        $user = User::where('id', $user_id)->where('reset_token', $token)->first();

        if ($user) {

            $new_password = str_random(6);

            $user->update([
                'password' => bcrypt($new_password),
                'reset_at' => NULL,
                'reset_token' => NULL,
            ]);

            Mail::send('emails.passwordreset', ['user_id' => $user->id, 'username' => $user->username, 'password' => $new_password], function ($message) use ($user)
            {
                $message->to($user->email);
                $message->subject("SMSLeader.pl - Nowe hasło");
            });

            alert()->success(Lang::get('auth.passwordreset.success'), 'Resetowanie hasła')->autoclose(2000);
             return redirect()->route('auth.signin');
        }

        return redirect()->route('auth.signin')->with('error', Lang::get('auth.passwordreset.failed'));
    }
}
