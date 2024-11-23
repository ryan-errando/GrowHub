@extends('layouts.user')

@section('title', 'Home')

@section('content')
<div class="space-y-8">
    {{-- Products Section --}}
    <section>
        <h2 class="text-2xl font-bold mb-4">Products</h2>
        
        @if($products->isEmpty())
            <p class="text-gray-500 text-center py-8">No products available.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if(count(json_decode($product->images)) > 0)
                        <img src="{{ asset('storage/' . json_decode($product->images)[0]) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-48 object-cover">
                    @endif
                    <div class="p-4">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $product->shop->name }}</p>
                            </div>
                            <span class="text-lg font-bold">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </span>
                        </div>
                        
                        <p class="text-gray-600 mb-4">
                            {{ Str::limit($product->description, 100) }}
                        </p>

                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="flex gap-2">
                                <input type="number" 
                                       name="quantity" 
                                       value="1" 
                                       min="1"
                                       class="w-20 border rounded px-2">
                                <button type="submit" 
                                        class="flex-1 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                    Add to Cart
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $products->links() }}
            </div>
        @endif
    </section>

    {{-- Services Section --}}
    <section>
        <h2 class="text-2xl font-bold mb-4">Services</h2>
        
        @if($services->isEmpty())
            <p class="text-gray-500 text-center py-8">No services available.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($services as $service)
                <div class="bg-white rounded-lg shadow-md p-4">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <h3 class="text-lg font-semibold">{{ $service->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $service->shop->name }}</p>
                        </div>
                        <span class="text-lg font-bold">
                            Rp {{ number_format($service->price_per_hour, 0, ',', '.') }}/hour
                        </span>
                    </div>
                    
                    <p class="text-gray-600 mb-2">
                        {{ Str::limit($service->description, 100) }}
                    </p>

                    <p class="text-sm text-gray-500 mb-4">
                        Minimum: {{ $service->minimum_hours }} hours
                        @if($service->maximum_hours)
                            | Maximum: {{ $service->maximum_hours }} hours
                        @endif
                    </p>

                    <a href="{{ route('services.show', $service->id) }}" 
                       class="block text-center bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        Book Service
                    </a>
                </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $services->links() }}
            </div>
        @endif
    </section>
</div>
@endsection