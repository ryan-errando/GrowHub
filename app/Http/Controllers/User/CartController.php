<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\serviceCartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController
{
    public function index()
    {
        // Get or create cart for current user
        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id()
        ]);

        $cartItems = $cart->cartItems()->with('product')->get();
        $serviceItems = $cart->serviceCartItems()->with('service')->get();

        $productSubtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $serviceSubtotal = $cart->serviceCartItems->sum(function ($item) {
            return $item->service->price_per_hour * $item->quantity;
        });

        $subtotal = $productSubtotal + $serviceSubtotal;

        return view('user.cart', compact('cartItems', 'serviceItems', 'subtotal'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'type' => 'required|in:product,service',
            'id' => 'required',
            'quantity' => 'required|integer|min:1',
            'start_date' => $request->type === 'service' ? 'required|date' : 'nullable'
        ]);

        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id()
        ]);

        if ($request->type === 'product') {
            CartItem::updateOrCreate(
                [
                    'cart_id' => $cart->id,
                    'product_id' => $request->id
                ],
                ['quantity' => $request->quantity]
            );
        } else {
            serviceCartItem::updateOrCreate(
                [
                    'cart_id' => $cart->id,
                    'service_id' => $request->id
                ],
                [
                    'quantity' => $request->quantity,
                    'start_date' => $request->start_date
                ]
            );
        }
        return redirect()->back()->with('success', 'Product added to cart');
    }

    public function updateQuantity(Request $request, $type, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::where('user_id', Auth::id())->first();

        if ($type === 'product') {
            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('id', $id)
                ->firstOrFail();
            $cartItem->update(['quantity' => $request->quantity]);
        } else {
            $serviceItem = ServiceCartItem::where('cart_id', $cart->id)
                ->where('id', $id)
                ->firstOrFail();
            $serviceItem->update(['quantity' => $request->quantity]);
        }

        return redirect()->back()->with('success', 'Cart updated successfully');
    }

    public function removeItem(Request $request, $type, $id)
    {
        if ($type === 'product') {
            CartItem::findOrFail($id)->delete();
        } else {
            ServiceCartItem::findOrFail($id)->delete();
        }
        return redirect()->route('user.cart')->with('success', 'Item removed from cart');
    }
}
