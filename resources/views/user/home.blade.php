@extends('layout.user')

@section('title', 'Home')

@section('content')
<div>
    <h1>Welcome, {{ Auth::user()->name }}</h1>
</div>

<!-- Hero Section -->
<div class="container py-5"> 
    <div class="row align-items-center">
        <!-- Left side content -->
        <div class="col-lg-6">
            <h1 class="display-3 mb-4" style="color: #214F3E; font-weight: bold;">
                Bring<br>
                Nature<br>
                Home
            </h1>
            
            <p class="lead mb-4" style="color: #333333;">
                Discover our curated collection<br>
                of rare and beautiful plants,<br>
                delivered with care to your<br>
                doorstep.
            </p>

            <a href="/collections" class="btn btn-lg px-4 py-2 text-white" 
               style="background-color: #214F3E; border-radius: 25px;">
                Our Collections
            </a>
        </div>

        <!-- Right side image -->
        <div class="col-lg-6">
            <div class="p-3" style="background-color: #ffffff; border-radius: 20px;">
                <img src="{{ asset('images/monstera-leaf.jpg') }}" 
                     alt="Monstera Leaf" 
                     class="img-fluid"
                     style="border-radius: 20px;">
            </div>
        </div>
    </div>
</div>

<!-- featured product -->
<div class="container py-5">
    <h2 class="mb-4" style="color: #214F3E;">Featured Plants</h2>
    <div class="row">
        @foreach($featuredProducts as $product)
        <div class="col-md-4 mb-4">
            <div class="card border-0 h-100" style="border-radius: 15px; overflow: hidden;">
                <div style="background-color: #fce5cd; height: 200px; display: flex; align-items: center; justify-content: center;">
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         class="img-fluid" 
                         alt="{{ $product->name }}"
                         style="object-fit: cover; height: 100%; width: 100%;">
                </div>
                <div class="card-body" style="background-color: #D1F2D9;">
                    <h5 class="card-title" style="color: #214F3E; font-weight: 600;">{{ $product->name }}</h5>
                    <p class="card-text mb-1" style="color: #666;">{{ $product->shop->name }}</p>
                    <p class="card-text" style="color: #214F3E; font-weight: 600;">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- services section -->
<div class="container py-5 mb-5" style="background-color: #f5f5f5; border-radius: 15px;">
    <div class="row align-items-center">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="p-3" style="border-radius: 20px;">
                <img src="{{ asset('images/gardening-service.jpg') }}" 
                     alt="Gardening Services" 
                     class="img-fluid"
                     style="border-radius: 20px; width: 100%; height: 400px; object-fit: cover;">
            </div>
        </div>
        <div class="col-lg-6 ps-lg-5">
            <h2 class="mb-4" style="color: #214F3E;">
                Elevate Your<br>
                Outdoor Oasis
            </h2>
            <p class="lead mb-4">
                Explore our premium gardening services, from landscape design to plant care. 
                Our team of experts will help you cultivate a beautiful, thriving outdoor space 
                tailored to your needs.
            </p>
            <a href="/services" class="btn btn-lg px-4 py-2 text-white" 
               style="background-color: #214F3E; border-radius: 25px;">
                Our Services
            </a>
        </div>
    </div>
</div>
<style>
    .btn:hover {
        background-color: #1a3f32 !important;
    }
</style>
@endsection