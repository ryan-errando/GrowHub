<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('id')) {
            if (session('role') === 'user') {
                return redirect()->route('user.home');
            } else {
                return redirect()->route('seller.dashboard');
            }
        }

        return $next($request);
    }
}