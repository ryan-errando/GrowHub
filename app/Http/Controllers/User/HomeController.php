<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController
{
    public function index()
    {
        $featuredProducts = Product::with('shop')->inRandomOrder()->take(3)->get();
        return view('user.home', compact('featuredProducts'));
    }
}
