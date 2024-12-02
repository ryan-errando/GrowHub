<?php

namespace App\Http\Controllers\Seller;

use App\Models\Seller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SellerProfileController
{
    public function index()
    {
        $seller = Auth::user();
        $shop = Shop::where('seller_id', Auth::id())->firstOrFail();
        return view('seller.profile', compact('seller', 'shop'));
    }

    public function update(Request $request)
    {
        $seller = Seller::find(Auth::id());
        $shop = Shop::where('seller_id', Auth::id())->firstOrFail();

        $validated = $request->validate([
            'shop_name' => 'sometimes|string|max:255',
            'name' => 'sometimes|string|max:255',
            'address' => 'sometimes|string',
            'phone' => 'sometimes|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Update shop name if provided
        if ($request->filled('shop_name')) {
            $shop->name = $validated['shop_name'];
            $shop->save();
        }

        // Create array of fields to update
        $sellerData = [];
        if ($request->filled('name')) {
            $sellerData['name'] = $validated['name'];
        }
        if ($request->filled('address')) {
            $sellerData['address'] = $validated['address'];
        }
        if ($request->filled('phone')) {
            $sellerData['phone'] = $validated['phone'];
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($seller->image) {
                Storage::disk('public')->delete($seller->image);
            }
            $imagePath = $request->file('image')->store('sellers', 'public');
            $sellerData['image'] = $imagePath;
        }

        // Update seller
        $seller->update($sellerData);

        return redirect()->route('seller.profile')->with('success', 'Profile updated successfully');
    }
}
