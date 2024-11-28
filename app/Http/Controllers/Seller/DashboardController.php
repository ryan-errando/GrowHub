<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;

class DashboardController
{
    public function index()
    {
        return view('seller.dashboard');
    }
}
