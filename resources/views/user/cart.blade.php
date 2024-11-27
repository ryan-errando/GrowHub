@extends('layout.user')

@section('title', Auth::user()->name . ' Cart')

@section('content')
<div class="container py-5">
    <h1 class="mb-5" style="color: #214F3E;">Your Cart</h1>

    @if($cartItems->count() > 0)
    @foreach($cartItems as $item)
    <div class="card mb-3 border-0" style="background-color: #fce5cd; border-radius: 15px;">
        <div class="row g-0 align-items-center p-3">
            <div class="col-2">
                <img src="{{ asset('storage/' . $item->product->image) }}"
                    class="img-fluid rounded"
                    alt="{{ $item->product->name }}"
                    style="width: 100px; height: 100px; object-fit: cover;">
            </div>
            <div class="col-6">
                <div class="card-body">
                    <h5 class="card-title" style="color: #214F3E;">Name: {{ $item->product->name }}</h5>
                    <p class="card-text" style="color: #214F3E;">
                        Price: Rp {{ number_format($item->product->price, 0, ',', '.') }}
                    </p>
                </div>
            </div>
            <div class="col-3">
                <div class="quantity-selector d-flex align-items-center justify-content-end">
                    <form action="{{ route('user.cart.update', $item) }}" method="POST" class="d-flex align-items-center">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                        <button type="submit" class="btn px-3 py-2" style="color: #214F3E;" {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                            -
                        </button>
                    </form>

                    <input type="number"
                        value="{{ $item->quantity }}"
                        class="form-control text-center"
                        style="width: 60px; background: none;"
                        readonly>

                    <form action="{{ route('user.cart.update', $item) }}" method="POST" class="d-flex align-items-center">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                        <button type="submit" class="btn px-3 py-2" style="color: #214F3E;">
                            +
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-1">
                <form action="{{ route('user.cart.remove', $item) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn text-danger">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <div class="text-end mt-4">
        <h4 style="color: #214F3E;">Subtotal: Rp {{ number_format($subtotal, 0, ',', '.') }}</h4>
    </div>
    @else
    <div class="card border-0 p-5 text-center" style="background-color: #f5f5f5; border-radius: 20px;">
        <div class="mb-4">
            <i class="bi bi-cart-x" style="font-size: 3rem; color: #214F3E;"></i>
        </div>
        <h4 class="mb-3" style="color: #214F3E;">Your cart is empty</h4>
        <p class="text-muted mb-4">Looks like you haven't added any plants to your cart yet.</p>
        <div>
            <a href="{{ route('user.product') }}" 
               class="btn px-4 py-2" 
               style="background-color: #214F3E; color: white; border-radius: 8px;">
                Continue Shopping
            </a>
        </div>
    </div>
    @endif
</div>

@endsection