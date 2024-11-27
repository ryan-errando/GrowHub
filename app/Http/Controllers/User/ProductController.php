<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController
{
    public function index()
    {
        $products = Product::with('shop')->paginate(9);
        return view('user.product', compact('products'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $products = Product::with('shop')
            ->where('name', 'like', "%{$search}%")
            ->paginate(9);

        return view('user.product', compact('products', 'search'));
    }

    public function detail($id)
    {
        $product = Product::with('shop')->findOrFail($id);
        return view('user.productDetail', compact('product'));
    }
}
