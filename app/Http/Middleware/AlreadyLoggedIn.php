<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AlreadyLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is already logged in
        if (Session::has('loginId')) {
            // If logged in, check if the current URL is login or registration
            if ($request->url() == url('login')) {
                // If on login or registration page, redirect back
                return back();
            } else {
                // If logged in but not on login or registration page, proceed with the request
                return $next($request);
            }
        }

        // If not logged in, proceed with the request
        return $next($request);
    }
}
