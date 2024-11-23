<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middlewareAliases = [
        // ... other middleware
        'auth' => \App\Http\Middleware\CheckLogin::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
    ];
}