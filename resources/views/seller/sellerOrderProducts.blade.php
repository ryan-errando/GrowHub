@extends('layout.seller')
@section('title', 'Seller Product Orders')
@php
use Illuminate\Support\Facades\Request;
@endphp
@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 style="color: #1b4332;">Seller Orders</h1>
        <div>
            <form id="sortForm" style="margin: 0;">
                <select name="sort" class="form-select" style="background-color: #E6D5C3; border: none;" onchange="this.form.submit()">
                    <option value="date_desc" {{ request('sort') == 'date_desc' ? 'selected' : '' }}>Date: Newest to oldest</option>
                    <option value="date_asc" {{ request('sort') == 'date_asc' ? 'selected' : '' }}>Date: Oldest to newest</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to low</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to high</option>
                </select>
            </form>
        </div>
    </div>

    <div class="nav nav-tabs mb-4">
        <a href="{{ route('seller.OrderProduct') }}" 
           class="nav-link {{ Request::is('sellerOrderProduct*') ? 'active' : '' }}" 
           style="color: {{ Request::is('sellerOrderProduct*') ? '#1b4332' : '#AAA' }}; 
                  border-color: {{ Request::is('sellerOrderProduct*') ? '#1b4332' : 'transparent' }};">
            Product
        </a>
        <a href="{{ route('seller.OrderService') }}" 
           class="nav-link {{ Request::is('sellerOrderService*') ? 'active' : '' }}" 
           style="color: {{ Request::is('sellerOrderService*') ? '#1b4332' : '#AAA' }}; 
                  border-color: {{ Request::is('sellerOrderService*') ? '#1b4332' : 'transparent' }};">
            Service
        </a>
    </div>

    @foreach($orders as $order)
    <div class="card mb-3" style="background-color: #E6D5C3; border: none;">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h5>OrderID: {{ $order->id }}</h5>
                    <p>Quantity: {{ $order->orderItems->sum('quantity') }} item(s)</p>
                    <p>Total: Rp{{ number_format($order->total_amount, 2) }}</p>
                    <p>Order Status: {{ ucfirst($order->status) }}</p>
                </div>
                <div class="d-flex flex-column gap-2">
                @if($order->status === 'processing')
                    <form action="{{ route('seller.updateProductOrderStatus', $order->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="completed">
                        <button type="submit" 
                                class="btn mb-2" 
                                style="background-color: #198754; color: white;"
                                onclick="return confirm('Are you sure you want to mark this order as completed?')">
                            Complete Order
                        </button>
                    </form>
                    
                    <form action="{{ route('seller.updateProductOrderStatus', $order->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="cancelled">
                        <button type="submit" 
                                class="btn" 
                                style="background-color: #dc3545; color: white;"
                                onclick="return confirm('Are you sure you want to cancel this order?')">
                            Cancel Order
                        </button>
                    </form>
                @endif
                <a href="#" 
                   class="btn" 
                   style="background-color: #1b4332; color: white;">
                    Order Detail
                </a>
</div>
            </div>
        </div>
    </div>
    @endforeach

    <div class="d-flex justify-content-center mt-4">
        <div class="pagination" style="display: flex; gap: 0.5rem; align-items: center;">
            @if ($orders->onFirstPage())
                <span style="background-color: #E6D5C3; color: black; border-radius: 50%; width: 2rem; height: 2rem; display: flex; align-items: center; justify-content: center;">
                    «
                </span>
            @else
                <a href="{{ $orders->previousPageUrl() }}" style="background-color: #E6D5C3; color: black; border-radius: 50%; width: 2rem; height: 2rem; display: flex; align-items: center; justify-content: center; text-decoration: none; cursor: pointer;">
                    «
                </a>
            @endif

            @for ($i = 1; $i <= min(3, $orders->lastPage()); $i++)
                @if ($orders->currentPage() == $i)
                    <span style="background-color: #1b4332; color: white; border-radius: 50%; width: 2rem; height: 2rem; display: flex; align-items: center; justify-content: center;">
                        {{ $i }}
                    </span>
                @else
                    <a href="{{ $orders->url($i) }}" style="background-color: #E6D5C3; color: black; border-radius: 50%; width: 2rem; height: 2rem; display: flex; align-items: center; justify-content: center; text-decoration: none; cursor: pointer;">
                        {{ $i }}
                    </a>
                @endif
            @endfor

            @if($orders->lastPage() > 3)
                <span style="background-color: #E6D5C3; color: black; border-radius: 50%; width: 2rem; height: 2rem; display: flex; align-items: center; justify-content: center;">
                    ...
                </span>
            @endif

            @if ($orders->hasMorePages())
                <a href="{{ $orders->nextPageUrl() }}" style="background-color: #E6D5C3; color: black; border-radius: 50%; width: 2rem; height: 2rem; display: flex; align-items: center; justify-content: center; text-decoration: none; cursor: pointer;">
                    »
                </a>
            @else
                <span style="background-color: #E6D5C3; color: black; border-radius: 50%; width: 2rem; height: 2rem; display: flex; align-items: center; justify-content: center;">
                    »
                </span>
            @endif
        </div>
    </div>
</div>
@endsection