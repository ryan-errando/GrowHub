<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class DashboardController
{
    public function index()
    {
        $user = Auth::user();
        $shop = Shop::where('seller_id', $user->id)->firstOrFail();
        
        $products = Product::where('shop_id', $shop->id)->get();
        $services = Service::where('shop_id', $shop->id)->get();
        
        return view('seller.dashboard', compact('shop', 'products', 'services'));
    }
}
