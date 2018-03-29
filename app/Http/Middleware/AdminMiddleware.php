<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware {

	public function __construct()
    {
    	
    }

    public function handle($request, Closure $next, $guard = null) 
    {
        if (Auth::check() && Auth::user()->admin == true) {
            return $next($request);
        }

        return redirect()->route('dashboard');
    }
}
