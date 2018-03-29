<?php

namespace App\Http\Controllers;

use DB;
use App\Earn;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RankController extends Controller{
    
    public function __construct(){
        $this->middleware('auth');
    }

    public function getTodayRank(){

        $listEarn = Earn::where('earns.created_at', '>=', Carbon::today()->toDateString())
        ->join('users', function($join){
            $join->on('users.id', '=', 'earns.user_id')->where('active', true)->where('ban', false);
        })->join('profiles', function($join){
            $join->on('profiles.user_id', '=', 'earns.user_id')->where('rank_view', '!=', 'hide');
        })->select(DB::raw("SUM(amount) as sumamount"), 'earns.user_id', 'users.username', 'profiles.rank_view')->orderBy('sumamount', 'desc')->limit(20)->groupBy('user_id')->get();

        $sumEarnAmount = Earn::where('earns.created_at', '>=', Carbon::today()->toDateString())
        ->join('profiles', function($join){
            $join->on('profiles.user_id', '=', 'earns.user_id')->where('rank_view', '!=', 'hide');
        })->get();
        
        return view('rank.earn', [
            'time' => 'Dzisiaj',
            'users' => $listEarn, 
            'topEarn' => $listEarn->first(),
            'maxEarnAmount' => $listEarn->max('sumamount'),
            'sumEarnAmount' => number_format($sumEarnAmount->sum('amount'), 2, '.', ''),
        ]);
    }

    public function getYesterdayRank(){   

        $listEarn = Earn::whereBetween('earns.created_at', [Carbon::now()->subDay()->toDateString(),Carbon::now()->toDateString()])->join('users', function($join){
            $join->on('users.id', '=', 'earns.user_id')->where('active', true)->where('ban', false);
        })->join('profiles', function($join){
            $join->on('profiles.user_id', '=', 'earns.user_id')->where('rank_view', '!=', 'hide');
        })->select(DB::raw("SUM(amount) as sumamount"), 'earns.user_id', 'users.username', 'profiles.rank_view')->orderBy('sumamount', 'desc')->limit(20)->groupBy('user_id')->get();

        $sumEarnAmount = Earn::whereBetween('earns.created_at', [Carbon::now()->subDay()->toDateString(),Carbon::now()->toDateString()])->join('profiles', function($join){
            $join->on('profiles.user_id', '=', 'earns.user_id')->where('rank_view', '!=', 'hide');
        })->get();

        return view('rank.earn', [
            'time' => 'Wczoraj',
            'users' => $listEarn, 
            'topEarn' => $listEarn->first(),
            'maxEarnAmount' => $listEarn->max('sumamount'),
            'sumEarnAmount' => number_format($sumEarnAmount->sum('amount'), 2, '.', ''),
        ]);
    }

    public function getWeekRank(){   

        $listEarn = Earn::whereBetween('earns.created_at', [Carbon::now()->subWeek()->toDateString(),Carbon::now()->addDay()->toDateString()])->join('users', function($join){
            $join->on('users.id', '=', 'earns.user_id')->where('active', true)->where('ban', false);
        })->join('profiles', function($join){
            $join->on('profiles.user_id', '=', 'earns.user_id')->where('rank_view', '!=', 'hide');
        })->select(DB::raw("SUM(amount) as sumamount"), 'earns.user_id', 'users.username', 'profiles.rank_view')->orderBy('sumamount', 'desc')->limit(20)->groupBy('user_id')->get();

        $sumEarnAmount = Earn::whereBetween('earns.created_at', [Carbon::now()->subWeek()->toDateString(),Carbon::now()->addDay()->toDateString()])->join('profiles', function($join){
            $join->on('profiles.user_id', '=', 'earns.user_id')->where('rank_view', '!=', 'hide');
        })->get();

        return view('rank.earn', [
            'time' => 'Ostatnie 7 dni',
            'users' => $listEarn, 
            'topEarn' => $listEarn->first(),
            'maxEarnAmount' => $listEarn->max('sumamount'),
            'sumEarnAmount' => number_format($sumEarnAmount->sum('amount'), 2, '.', ''),
        ]);
    }

    public function getMonthRank(){   

        $listEarn = Earn::whereBetween('earns.created_at', [Carbon::now()->subMonth()->toDateString(),Carbon::now()->addDay()->toDateString()])->join('users', function($join){
            $join->on('users.id', '=', 'earns.user_id')->where('active', true)->where('ban', false);
        })->join('profiles', function($join){
            $join->on('profiles.user_id', '=', 'earns.user_id')->where('rank_view', '!=', 'hide');
        })->select(DB::raw("SUM(amount) as sumamount"), 'earns.user_id', 'users.username', 'profiles.rank_view')->orderBy('sumamount', 'desc')->limit(20)->groupBy('user_id')->get();

        $sumEarnAmount = Earn::whereBetween('earns.created_at', [Carbon::now()->subMonth()->toDateString(),Carbon::now()->addDay()->toDateString()])->join('profiles', function($join){
            $join->on('profiles.user_id', '=', 'earns.user_id')->where('rank_view', '!=', 'hide');
        })->get();

        return view('rank.earn', [
            'time' => 'Ostatnie 30 dni',
            'users' => $listEarn, 
            'topEarn' => $listEarn->first(),
            'maxEarnAmount' => $listEarn->max('sumamount'),
            'sumEarnAmount' => number_format($sumEarnAmount->sum('amount'), 2, '.', ''),
        ]);
    }

    public function getAllRank(){

        $listEarn = User::where('active', true)->where('ban', false)->where('earn', '>', '0')->join('profiles', function($join){
            $join->on('profiles.user_id', '=', 'users.id')->where('rank_view', '!=', 'hide');
        })->select('users.earn as sumamount', 'users.username', 'profiles.rank_view')->orderBy('sumamount', 'desc')->limit(20)->get();

        $sumEarnAmount = User::where('active', true)->where('ban', false)->where('earn', '>', '0')->join('profiles', function($join){
            $join->on('profiles.user_id', '=', 'users.id')->where('rank_view', '!=', 'hide');
        })->get();

        return view('rank.earn', [
            'time' => 'Od początku',
            'users' => $listEarn, 
            'topEarn' => $listEarn->first(),
            'maxEarnAmount' => $listEarn->max('sumamount'),
            'sumEarnAmount' => number_format($sumEarnAmount->sum('earn'), 2, '.', ''),
        ]);
    }
}
