@extends('layout.seller')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid" style="padding: 1.5rem; background-color: white; border-radius: 0.5rem;">
    <h1 style="font-size: 1.875rem; font-weight: bold; color: #065f46; margin-bottom: 2rem;">Welcome, {{ $shop->name }}</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Products Section -->
    <div class="card mb-4">
        <div class="card-header" style="background-color: #f3f4f6;">
            <h2 style="font-size: 1.5rem; font-weight: 600; color: #065f46; margin-bottom: 0;">Your Products</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>Rp {{ number_format($product->price, 2) }}</td>
                            <td>
                                @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 4rem; height: 4rem; object-fit: cover;">
                                @endif
                            </td>
                            <td>
                                <div class="d-flex flex-column gap-2">
                                    <form action="{{ route('sellerProducts.edit', $product->id) }}" method="GET">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Update</button>
                                    </form>

                                    <form action="{{ route('sellerProducts.destroy', $product->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div class="card">
        <div class="card-header" style="background-color: #f3f4f6;">
            <h2 style="font-size: 1.5rem; font-weight: 600; color: #065f46; margin-bottom: 0;">Your Services</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Service ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price/hour</th>
                            <th>Availability</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                        <tr>
                            <td>{{ $service->id }}</td>
                            <td>{{ $service->name }}</td>
                            <td>{{ $service->description }}</td>
                            <td>Rp {{ number_format($service->price_per_hour, 2) }}</td>
                            <td class="{{ $service->is_available ? 'text-success' : 'text-danger' }} fw-bold">
                                {{ $service->is_available ? 'Available' : 'Not Available' }}
                            </td>
                            <td>
                                @if($service->image)
                                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" style="width: 4rem; height: 4rem; object-fit: cover;">
                                @endif
                            </td>
                            <td>
                                <div class="d-flex flex-column gap-2">
                                    <form action="{{ route('sellerServices.edit', $service->id) }}" method="GET">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Update</button>
                                    </form>

                                    <form action="{{ route('sellerServices.destroy', $service->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this service?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection