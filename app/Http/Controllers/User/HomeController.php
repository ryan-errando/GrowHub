<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('shop')
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        $services = Service::with('shop')
            ->where('is_available', true)
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('user.home', compact('products', 'services'));
    }
}
