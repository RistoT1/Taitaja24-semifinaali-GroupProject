<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            return redirect('/me');
        }

        if ($request->session()->has('2fa:user_id')) {
            return $next($request);
        }

        return redirect('/kirjaudu');
    }
}
