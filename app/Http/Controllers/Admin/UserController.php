<?php

namespace App\Http\Controllers\Admin;

use Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Http\Controllers\Controller;

class UserController extends Controller{

    public function getUser(){

        $users = User::paginate(15);
        $usersActive = User::active(true)->ban(false)->count();
        $usersNoActive = User::active(true)->ban(false)->count();
        $usersBalance = User::active(true)->ban(false)->where('balance', '>=',  Setting::get('withdraw_standard_limit'))->sum('balance');
        $usersBan = User::ban(true)->count();

        return view('admin.user.list', [
            'users' => $users,
            'usersActive' => $usersActive,
            'usersNoActive' => $usersNoActive,
            'usersBalance' => $usersBalance,
            'usersBan' => $usersBan,
        ]);

    }

    public function getUserDetail($id){

    	$user = User::where('id', $id)->first();

    	if (!$user){
            alert()->error('Taki użytkownik nie istnieje w bazie!', 'Użytkownik nie istnieje!');

            return redirect()->route('admin.user.list');
        }

		return view('admin.user.detail', [
		    'user' => $user,
		]);

    }

    public function getUserDetailWithdraw($id){
        
        $user = User::where('id', $id)->first();

        if (!$user){
            alert()->error('Taki użytkownik nie istnieje w bazie!', 'Użytkownik nie istnieje!');

            return redirect()->route('admin.user.list');
        }

        $withdraws = $user->payout()->orderby('payout_id', 'desc')->paginate(15);
        $withdrawsWait = $user->payout()->wait();
        $withdrawsNotConfirm = $user->payout()->notconfirm();
        $withdrawsPay = $user->payout()->pay();
        $withdrawsCancel = $user->payout()->cancel();

        return view('admin.user.withdraw', [
            'user' => $user,
            'withdraws' => $withdraws,
            'withdrawsWait' => $withdrawsWait,
            'withdrawsNotConfirm' => $withdrawsNotConfirm,
            'withdrawsPay' => $withdrawsPay,
            'withdrawsCancel' => $withdrawsCancel,
        ]);
    }
}
