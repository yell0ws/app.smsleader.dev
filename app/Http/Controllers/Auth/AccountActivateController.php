<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Traits\LogTrait;
use SumanIon\CloudFlare;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

class AccountActivateController extends Controller{
    
    use LogTrait;

    public function __construct(){

        $this->middleware('guest');
    }


    public function getAccountActivate($user_id, $token){	
        
        $user = User::where('id', $user_id)->first();

        if ($user) {
            $activation = $user->activation()->where('token', $token)->first();

            if ($activation) {
                $activation->delete();

                $user->update([
                    'active' => true
                ]);

                $this->LogFile('auth', 'Poprawnie aktywowano konto', [
                    'user_id' => $user->id,
                    'ip' => Cloudflare::ip(),
                ]);

                alert()->success(Lang::get('auth.accountactivate.success'), 'Aktywne konto')->autoclose(2000);

                return redirect()->route('auth.signin');
            }
        }

        return redirect()->back()->with('error', Lang::get('auth.accountactivate.failed'));

        return redirect()->route('auth.signin');
    }
}

