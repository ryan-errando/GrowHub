@extends('layouts.user')

@section('title', 'Cart')

@section('content')
<div class="bg-white rounded-lg shadow">
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4">Shopping Cart</h2>

        @if($cart && $cart->cartItems->count() > 0)
            <div class="space-y-4">
                @foreach($cart->cartItems as $item)
                <div class="flex items-center justify-between border-b pb-4">
                    <div class="flex items-center space-x-4">
                        <img src="{{ asset('storage/' . json_decode($item->product->images)[0]) }}" 
                             alt="{{ $item->product->name }}" 
                             class="w-16 h-16 object-cover rounded">
                        <div>
                            <h3 class="font-semibold">{{ $item->product->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $item->product->shop->name }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <form action="{{ route('user.cart.update', $item->id) }}" method="POST" class="flex items-center">
                            @csrf
                            @method('PATCH')
                            <input type="number" 
                                   name="quantity" 
                                   value="{{ $item->quantity }}" 
                                   min="1" 
                                   class="w-20 rounded border-gray-300">
                            <button type="submit" class="ml-2 text-blue-500 hover:text-blue-700">Update</button>
                        </form>
                        <span class="text-lg font-semibold">
                            Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                        </span>
                        <form action="{{ route('user.cart.remove', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Remove</button>
                        </form>
                    </div>
                </div>
                @endforeach

                <div class="flex justify-between items-center pt-4">
                    <div>
                        <span class="text-lg font-bold">Total:</span>
                        <span class="text-xl font-bold">
                            Rp {{ number_format($cart->cartItems->sum(function($item) {
                                return $item->product->price * $item->quantity;
                            }), 0, ',', '.') }}
                        </span>
                    </div>
                    <form action="{{ route('user.orders.create') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-500 text-white px-6 py-3 rounded hover:bg-green-600">
                            Checkout
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="text-center py-8">
                <p class="text-gray-600">Your cart is empty</p>
                <a href="{{ route('home') }}" class="mt-4 inline-block text-blue-500 hover:text-blue-700">
                    Continue Shopping
                </a>
            </div>
        @endif
    </div>
</div>
@endsection