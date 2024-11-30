<?php

namespace App\Http\Controllers\Seller;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerProductController 
{
    public function create()
    {
        $shop = Shop::where('seller_id', Auth::id())->firstOrFail();
        
        return view('seller.addProduct', compact('shop'));
    }

    public function store(Request $request)
    {
     
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            // 'stock' => 'required|integer|min:0',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'shop_id' => 'required|exists:shops,id'
        ]);

        // // Handle image upload if present
        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->store('products', 'public');
        //     $validated['image'] = $imagePath;
        // }

        // Create the product
        Product::create($validated);

        return redirect()->route('seller.dashboard')
            ->with('success', 'Product added successfully!');
    }

    public function edit(Product $product)
{
    return view('seller.updateProduct', compact('product'));
}


    public function update(Request $request, Product $product)
{
    $validated = $request->validate([
        'name' => 'required|max:255',
        'description' => 'required',
        'price' => 'required|numeric|min:0',
        'shop_id' => 'required|exists:shops,id',
    ]);

    $product->update($validated);

    return redirect()->route('seller.dashboard')
        ->with('success', 'Product updated successfully!');
}

public function destroy($id)
{
    $product = Product::findOrFail($id);
    $product->delete();

    // Redirect back to the seller dashboard after deletion
    return redirect()->route('seller.dashboard')->with('success', 'Product deleted successfully!');
}


}