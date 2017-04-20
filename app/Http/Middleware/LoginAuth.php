<?php

namespace App\Http\Middleware;

use Redirect, Closure;

class LoginAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (empty($request->session()->get('user'))) {
            return Redirect::to('/login');
        }

        return $next($request);
    }
}
