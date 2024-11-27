@extends('layout.user')

@section('title', 'Product')

@section('content')
<div class="container py-5">
    <!-- Header -->
    <div class="row mb-5 align-items-center">
        <div class="col-md-6">
            <h1 style="color: #214F3E; font-weight: bold;">Our<br>Collections</h1>
        </div>
        <div class="col-md-6">
            <form action="{{ route('user.product.search') }}" method="GET">
                <div class="input-group">
                    <input type="text"
                        class="form-control py-2 ps-4"
                        placeholder="Search"
                        name="search"
                        value="{{ $search ?? '' }}"
                        style="border-radius: 25px; background-color: #E8E8E8; border: none;">
                    <button class="btn" type="submit"
                        style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); z-index: 10;">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="row g-4">
        @foreach($products as $product)
            @include('components.productCard')
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5">
        <nav>
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($products->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">&laquo;</span>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $products->previousPageUrl() }}">&laquo;</a>
                </li>
                @endif

                {{-- Pagination Elements --}}
                @php
                $start = max(1, $products->currentPage() - 2);
                $end = min($start + 4, $products->lastPage());
                if ($end - $start < 4) {
                    $start=max(1, $end - 4);
                    }
                    @endphp

                    {{-- First Page + Dots --}}
                    @if($start> 1)
                    <li class="page-item">
                        <a class="page-link" href="{{ $products->url(1) }}">1</a>
                    </li>
                    @if($start > 2)
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                    @endif
                    @endif

                    {{-- Page Links --}}
                    @for ($i = $start; $i <= $end; $i++)
                        <li class="page-item {{ $products->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                        </li>
                        @endfor

                        {{-- Last Page + Dots --}}
                        @if($end < $products->lastPage())
                            @if($end < $products->lastPage() - 1)
                                <li class="page-item disabled">
                                    <span class="page-link">...</span>
                                </li>
                                @endif
                                <li class="page-item">
                                    <a class="page-link" href="{{ $products->url($products->lastPage()) }}">{{ $products->lastPage() }}</a>
                                </li>
                                @endif

                                {{-- Next Page Link --}}
                                @if ($products->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $products->nextPageUrl() }}">&raquo;</a>
                                </li>
                                @else
                                <li class="page-item disabled">
                                    <span class="page-link">&raquo;</span>
                                </li>
                                @endif
            </ul>
        </nav>
    </div>
</div>

<style>
    .card {
        transition: transform 0.2s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .page-link {
        color: #214F3E;
        border: none;
        padding: 8px 16px;
        margin: 0 4px;
        border-radius: 50%;
    }

    .page-item.active .page-link {
        background-color: #214F3E;
        color: white;
    }

    .page-link:hover {
        background-color: #D1F2D9;
        color: #214F3E;
    }

    .page-item.disabled .page-link {
        background-color: transparent;
        color: #6c757d;
    }
</style>
@endsection