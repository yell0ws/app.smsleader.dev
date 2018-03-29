<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public function getDashboard(){   

        $sumTodayEarn =  Auth::user()->earn()->where('created_at', '>=', Carbon::today()->toDateString())->first(['amount']);
        $sumTodayViews = Auth::user()->view()->where('created_at', '>=', Carbon::today()->toDateString())->sum('id');
        $lastLeads = Auth::user()->lead()->get();
        $getPosts = Post::orderBy('created_at', 'desc')->take(6)->get();
        $countTodayLeads = $lastLeads->where('created_at', '>=', Carbon::today()->toDateString());

        return view('dashboard', [
            'lastLeads' => $lastLeads,
            'posts' => $getPosts,
            'onlineUsers' => NULL,
            'sumTodayEarn' => $sumTodayEarn,
            'sumTodayViews' => $sumTodayViews,
            'conversionToday' => round(($countTodayLeads->count()/1)*100, 2),
            'countTodayLeads' => $countTodayLeads->count(),
        ]);
    }
}
