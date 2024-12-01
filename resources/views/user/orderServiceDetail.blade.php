@extends('layout.user')
@section('title', 'Service Order Detail')

@section('content')
<div class="container py-5">
    <a href="{{ route('user.orderServices') }}" class="text-decoration-none" style="color: #1b4332;">
        <i class="bi bi-arrow-left"></i> Back
    </a>

    <h1 style="color: #1b4332; margin-top: 2rem;">Order</h1>
    <h2 style="color: #1b4332; margin-bottom: 2rem;">ID: {{ $order->id }}</h2>

    <h3 style="color: #1b4332; margin-bottom: 1.5rem;">Service(s)</h3>

    @foreach($order->serviceOrderItems as $item)
        <div class="card mb-3" style="background-color: #E6D5C3; border: none; border-radius: 15px;">
            <div class="row g-0 p-3">
                <div class="col-md-3">
                    <img src="{{ asset('storage/' . $item->service->image) }}" 
                         class="img-fluid rounded" 
                         style="width: 150px; height: 150px; object-fit: cover;">
                </div>
                <div class="col-md-9">
                    <div class="card-body">
                        <h4 style="color: #1b4332;">Name: {{ $item->service->name }}</h4>
                        <p style="color: #1b4332;">Price per Hour: ${{ number_format($item->price, 2) }}</p>
                        <p style="color: #1b4332;">Hours: {{ $item->quantity }}</p>
                        <p style="color: #1b4332;">Start Date: {{ \Carbon\Carbon::parse($item->start_date)->format('d M Y H:i') }}</p>
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