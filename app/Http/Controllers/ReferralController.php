<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\User;
use Illuminate\Http\Request;

class ReferralController extends Controller{
    
     public function __construct(){

        $this->middleware('auth', ['except' => [
            'getReferralRedirect',
        ]]);

        $this->middleware('guest', ['only' => [
            'getReferralRedirect',
        ]]);
    }

    public function getReferralList(){	

        $getReferrals = User::where('referral', Auth::user()->id)->active(true)->ban(false)
        ->join('referral_earns', function($join){
            $join->on('referral_earns.user_id', '=', 'users.id')->where('referral_earns.referral_id', '=', Auth::user()->id);
        })->select('user_id', 'username', DB::raw("SUM(amount) as sumamount"), 'users.created_at')
        ->orderBy('users.created_at', 'asc')
        ->groupBy('referral_earns.user_id');

        return view('referral.list', [
        	'referrals' => $getReferrals->paginate(30),
        	'referralsCount' => $getReferrals->count(),
            'sumReferralsAmount' => number_format($getReferrals->get()->sum('sumamount'), 2, '.', ''),
        ]);
    }

    public function getReferralRedirect($referral_id){   

        $referral = User::where('referral_id', $referral_id)->first(['id']);

        if ($referral) {
            $cookie = cookie('referral', $referral->id, 1440);
            return redirect()->route('auth.signup')->withCookie($cookie);
        }

        return redirect()->route('auth.signup');
    }
}
