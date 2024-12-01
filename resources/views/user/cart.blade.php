@extends('layout.user')
@section('title', Auth::user()->name . ' Cart')

@section('content')
<div class="container py-5">
    <h1 class="mb-5" style="color: #214F3E;">Your Cart</h1>

    @if($cartItems->count() > 0 || $serviceItems->count() > 0)
    @if($cartItems->count() > 0)
    <h4 class="mb-4" style="color: #214F3E;">Product(s)</h4>

    @foreach($cartItems->groupBy(function($item) { return $item->product->shop_id; }) as $shopId => $shopItems)
    <div class="shop-section mb-4">
        <h5 class="mb-3" style="color: #214F3E; padding-left: 10px;">{{ $shopItems->first()->product->shop->name }}</h5>

        @foreach($shopItems as $item)
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
                        <h6 class="card-title" style="color: #214F3E; margin-bottom: 5px;">
                            Name: {{ $item->product->name }}
                        </h6>
                        <p class="card-text" style="color: #214F3E; margin-bottom: 0;">
                            Price: Rp {{ number_format($item->product->price, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
                <div class="col-3">
                    <div class="quantity-selector d-flex align-items-center">
                        <form action="{{ route('user.cart.update', ['type' => 'product', 'id' => $item->id]) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                            <button type="submit" {{ $item->quantity <= 1 ? 'disabled' : '' }}>-</button>
                        </form>

                        <input type="number" value="{{ $item->quantity }}" readonly>

                        <form action="{{ route('user.cart.update', ['type' => 'product', 'id' => $item->id]) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                            <button type="submit">+</button>
                        </form>
                    </div>
                </div>
                <div class="col-1">
                    <form action="{{ route('user.cart.remove', ['type' => 'product', 'id' => $item->id]) }}" method="POST">
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
    </div>
    @endforeach
    @endif

    @if($serviceItems->count() > 0)
    <h4 class="mb-4 mt-5" style="color: #214F3E;">Service(s)</h4>

    @foreach($serviceItems->groupBy(function($item) { return $item->service->shop_id; }) as $shopId => $shopItems)
    <div class="shop-section mb-4">
        <h5 class="mb-3" style="color: #214F3E; padding-left: 10px;">{{ $shopItems->first()->service->shop->name }}</h5>

        @foreach($shopItems as $item)
        <div class="card mb-3 border-0" style="background-color: #fce5cd; border-radius: 15px;">
            <div class="row g-0 align-items-center p-3">
                <div class="col-2">
                    <img src="{{ asset('storage/' . $item->service->image) }}"
                        class="img-fluid rounded"
                        alt="{{ $item->service->name }}"
                        style="width: 100px; height: 100px; object-fit: cover;">
                </div>
                <div class="col-6">
                    <div class="card-body">
                        <h6 class="card-title" style="color: #214F3E; margin-bottom: 5px;">
                            Name: {{ $item->service->name }}
                        </h6>
                        <p class="card-text" style="color: #214F3E; margin-bottom: 5px;">
                            Price: Rp {{ number_format($item->service->price_per_hour, 0, ',', '.') }} / Hour
                        </p>
                        <p class="card-text" style="color: #214F3E; margin-bottom: 0;">
                            Start Time: {{ \Carbon\Carbon::parse($item->start_date)->format('d M Y H:i') }}
                        </p>
                    </div>
                </div>
                <div class="col-3">
                    <div class="quantity-selector d-flex align-items-center">
                        <form action="{{ route('user.cart.update', ['type' => 'service', 'id' => $item->id]) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                            <button type="submit" {{ $item->quantity <= 1 ? 'disabled' : '' }}>-</button>
                        </form>

                        <input type="number" value="{{ $item->quantity }}" readonly>

                        <form action="{{ route('user.cart.update', ['type' => 'service', 'id' => $item->id]) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                            <button type="submit">+</button>
                        </form>
                    </div>
                </div>
                <div class="col-1">
                    <form action="{{ route('user.cart.remove', ['type' => 'service', 'id' => $item->id]) }}" method="POST">
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
    </div>
    @endforeach
    @endif

    <div class="text-end mt-4">
        <h4 style="color: #214F3E;">Subtotal: Rp {{ number_format($subtotal, 0, ',', '.') }}</h4>

        <form action="{{ route('user.processOrder') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="btn" style="background-color: #1b4332; color: white; border: none; padding: 0.75rem 2rem;">
                Place Order
            </button>
        </form>
    </div>

    @else
    <div class="card border-0 p-5 text-center" style="background-color: #f5f5f5; border-radius: 20px;">
        <div class="mb-4">
            <i class="bi bi-cart-x" style="font-size: 3rem; color: #214F3E;"></i>
        </div>
        <h4 class="mb-3" style="color: #214F3E;">Your cart is empty</h4>
        <p class="text-muted mb-4">Looks like you haven't added any items to your cart yet.</p>
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

<style>
    .quantity-selector button {
        border: none;
        background: none;
        outline: none;
        color: #214F3E;
        font-weight: 500;
    }

    .quantity-selector button:hover {
        background-color: rgba(33, 79, 62, 0.1);
    }

    .quantity-selector button:focus {
        outline: none;
    }

    .quantity-selector input {
        border: none;
        width: 40px;
        text-align: center;
        background: none;
        outline: none;
    }

    .shop-section {
        border-left: 4px solid #214F3E;
        padding-left: 15px;
        margin-bottom: 30px;
    }
</style>
@endsection