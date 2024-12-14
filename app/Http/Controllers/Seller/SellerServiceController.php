<?php

namespace App\Http\Controllers\Seller;

use App\Models\Service;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerServiceController 
{
    public function create()
    {
        $shop = Shop::where('seller_id', Auth::id())->firstOrFail();
        
        return view('seller.addService', compact('shop'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price_per_hour' => 'required|numeric|min:0',
            'minimum_hour' => 'required|integer|min:1',
            'maximum_hour' => 'required|integer|min:1|gte:minimum_hour',
            'is_available' => 'sometimes|boolean',
            'shop_id' => 'required|exists:shops,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('services', 'public');
            $validated['image'] = $imagePath;
        }

        $validated['is_available'] = $request->has('is_available') ? 1 : 0;

        Service::create($validated);

        return redirect()->route('seller.dashboard')
            ->with('success', 'Service added successfully!');
    }

    public function edit(Service $service)
    {
        return view('seller.updateService', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price_per_hour' => 'required|numeric|min:0',
            'minimum_hour' => 'required|integer|min:1',
            'maximum_hour' => 'required|integer|min:1|gte:minimum_hour',
            'is_available' => 'sometimes|boolean',
            'shop_id' => 'required|exists:shops,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480'
        ]);

        if ($request->hasFile('image')) {
            // Store new image
            $imagePath = $request->file('image')->store('services', 'public');
            $validated['image'] = $imagePath;
        } else {
            // Keep the existing image path
            $validated['image'] = $service->image;
        }

        $validated['is_available'] = $request->has('is_available') ? 1 : 0;

        $service->update($validated);

        return redirect()->route('seller.dashboard')
            ->with('success', 'Service updated successfully!');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('seller.dashboard')
            ->with('success', 'Service deleted successfully!');
    }
}