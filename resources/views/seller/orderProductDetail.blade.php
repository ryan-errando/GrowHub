@extends('layout.seller')
@section('title', 'Order Detail')

@section('content')
<div class="container py-5">
    <a href="{{ route('seller.OrderProduct') }}" class="text-decoration-none" style="color: #1b4332;">
        <i class="bi bi-arrow-left"></i> Back
    </a>

    <h1 style="color: #1b4332; margin-top: 2rem;">Order</h1>
    <h2 style="color: #1b4332; margin-bottom: 2rem;">ID: {{ $order->id }}</h2>

    <div class="d-flex justify-content-between align-items-start mb-4">
        <h3 style="color: #1b4332;">Product(s)</h3>
        @if($order->status === 'processing')
            <div class="d-flex gap-2">
                <form action="{{ route('seller.updateProductOrderStatus', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="completed">
                    <button type="submit" 
                            class="btn btn-success"
                            onclick="return confirm('Are you sure you want to mark this order as completed?')">
                        Complete Order
                    </button>
                </form>
                
                <form action="{{ route('seller.updateProductOrderStatus', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="cancelled">
                    <button type="submit" 
                            class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to cancel this order?')">
                        Cancel Order
                    </button>
                </form>
            </div>
        @endif
    </div>

    @foreach($order->orderItems as $item)
        <div class="card mb-3" style="background-color: #E6D5C3; border: none; border-radius: 15px;">
            <div class="row g-0 p-3">
                <div class="col-md-3">
                    <img src="{{ asset('storage/' . $item->product->image) }}" 
                         class="img-fluid rounded" 
                         style="width: 150px; height: 150px; object-fit: cover;">
                </div>
                <div class="col-md-9">
                    <div class="card-body">
                        <h4 style="color: #1b4332;">Name: {{ $item->product->name }}</h4>
                        <p style="color: #1b4332;">Price: ${{ number_format($item->price, 2) }}</p>
                        <p style="color: #1b4332;">Quantity: {{ $item->quantity }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="mt-4" style="color: #1b4332;">
        <h4>Total: ${{ number_format($order->total_amount, 2) }}</h4>
        <h4>Payment Method: Virtual Account</h4>
        <h4>Order Status: {{ ucfirst($order->status) }}</h4>
    </div>
</div>
@endsection