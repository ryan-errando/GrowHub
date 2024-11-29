<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Product;
use App\Models\Service;

class DashboardController
{
    public function index()
    {
        $user = auth()->user();
        $shop = Shop::where('seller_id', $user->id)->firstOrFail();
        
        $products = Product::where('shop_id', $shop->id)->get();
        $services = Service::where('shop_id', $shop->id)->get();
        
        return view('seller.dashboard', compact('shop', 'products', 'services'));
    }
}
