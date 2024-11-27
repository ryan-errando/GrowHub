<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\CartItem;
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

        $subtotal = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        return view('user.cart', compact('cartItems', 'subtotal'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        // Get or create cart
        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id()
        ]);

        // Update or create cart item
        $cartItem = CartItem::updateOrCreate(
            [
                'cart_id' => $cart->id,
                'product_id' => $request->product_id
            ],
            [
                'quantity' => $request->quantity
            ]
        );
        return redirect()->back()->with('success', 'Product added to cart');
    }

    public function updateQuantity(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
    
        $cartItem->update([
            'quantity' => $request->quantity
        ]);
    
        // Get updated cart total
        $cart = $cartItem->cart;
        $subtotal = $cart->cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });
    
        return redirect()->back()->with('success', 'Cart updated successfully');
    }

    public function removeItem(CartItem $cartItem)
    {
        $cartItem->delete();
        return redirect()->route('user.cart')->with('success', 'Item removed from cart');
    }
}
