<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Traits\LogTrait;
use SumanIon\CloudFlare;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

class SignoutController extends Controller{
    
	use LogTrait;

    public function __construct(){
        
        $this->middleware('auth');
    }

    public function getSignout(){

        $this->LogFile('auth', 'Wylogowano z konta', [
            'user_id' => Auth::user()->id,
            'ip' => Cloudflare::ip(),
        ]);

        Auth::logout();

        alert()->success(Lang::get('auth.signout'), 'Pomyślnie wylogowano');
        return redirect()->route('auth.signin');
    }
}
