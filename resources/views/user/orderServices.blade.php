@extends('layout.user')
@section('title', 'Service Orders')
@php
use Illuminate\Support\Facades\Request;
@endphp
@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 style="color: #1b4332;">Orders</h1>
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
        <a href="{{ route('user.orderProducts') }}"
            class="nav-link {{ Request::is('orderProducts*') ? 'text-success active border-success border-bottom-2' : 'text-muted' }}">
            Product
        </a>
        <a href="{{ route('user.orderServices') }}"
            class="nav-link {{ Request::is('orderServices*') ? 'text-success active border-success border-bottom-2' : 'text-muted' }}">
            Service
        </a>
    </div>

    @foreach($orders as $order)
    <div class="card mb-3" style="background-color: #E6D5C3; border: none;">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h5>OrderID: {{ $order->id }}</h5>
                    <p>Quantity: {{ $order->serviceOrderItems->sum('quantity') }} service(s)</p>
                    <p>Total: Rp{{ number_format($order->total_amount, 2) }}</p>
                    <p>Order Status: {{ ucfirst($order->status) }}</p>
                </div>
                <a href="{{ route('user.orderServiceDetail', $order) }}"
                    class="btn"
                    style="background-color: #1b4332; color: white;">
                    Order Detail
                </a>
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