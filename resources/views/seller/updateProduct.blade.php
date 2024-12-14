@extends('layout.seller')

@section('title', 'Update Product')

@section('content')
<div class="container-fluid" style="padding: 1.5rem; background-color: white; border-radius: 0.5rem;">
    <h1 style="font-size: 1.875rem; font-weight: bold; color: #1b4332; margin-bottom: 2rem;">Update Product</h1>

    <div style="max-width: 800px;">
        <h2 style="font-size: 1.5rem; font-weight: 600; color: #1b4332; margin-bottom: 1.5rem;">Product Info</h2>

        <form action="{{ route('sellerProducts.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- For Laravel to recognize this as an update request -->

            <!-- Hidden input for shop_id -->
            <input type="hidden" name="shop_id" value="{{ $product->shop_id }}">

            <div class="mb-3">
                <label class="form-label" style="color: #1b4332;">Name:</label>
                <input 
                    type="text" 
                    name="name" 
                    class="form-control" 
                    style="background-color: #E6D5C3; border: none;" 
                    placeholder="{{ $product->name }}" 
                     value="{{ old('name', $product->name) }}"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label" style="color: #1b4332;">Description:</label>
                <textarea 
                    name="description" 
                    class="form-control" 
                    style="background-color: #E6D5C3; border: none; height: 120px;" 
                    placeholder="{{ $product->description }}" 
                    required>{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label" style="color: #1b4332;">Price:</label>
                <input 
                    type="number" 
                    name="price" 
                    class="form-control" 
                    style="background-color: #E6D5C3; border: none;" 
                    placeholder="{{ $product->price }}" 
                    step="0.01" 
                    value="{{ old('price', $product->price) }}"
                    required>
            </div>

            
            <!-- Uncomment this section if you want to allow updating the image -->
            <div class="mb-4">
                <label class="form-label" style="color: #1b4332;">Image:</label>
                <input 
                    type="file" 
                    name="image" 
                    class="form-control" 
                    style="background-color: #E6D5C3; border: none;" 
                    accept="image/*">
            </div>

            <button type="submit" class="btn btn-success" style="background-color: #1b4332; border: none; padding: 0.5rem 2rem;">
                Update Product
            </button>
        </form>
    </div>
</div>
@endsection
