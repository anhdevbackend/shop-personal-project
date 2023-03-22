<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if(!empty(Auth::user())){
            // If we go Login Page && Register page from login stated
            if(url()->current() == route('auth#loginPage') || url()->current() == route('auth#registerPage')){
                return back();
            }

            if(Auth::user()->role == 'user'){
                abort(404);
            }

            return $next($request);
        }

        return $next($request);
    }
}
