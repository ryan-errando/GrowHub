<?php

// app/Http/Middleware/CheckAuth.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLogin
{
    public function handle(Request $request, Closure $next, $role = null)
    {
        if (!session()->has('user_id')) {
            return redirect()->route('login');
        }

        if ($role && session('user_role') !== $role) {
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}

// app/Http/Kernel.php
