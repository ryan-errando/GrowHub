@extends('layout.seller')

@section('title', 'Shop Profile')

@section('content')
<div class="container py-5">
    <h1 class="mb-4" style="color: #1b4332;">Profile</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="card border-0" style="background-color: #E6D5C3;">
        <div class="card-body p-4">
            <form action="{{ route('seller.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="text-center">
                            <img src="{{ auth()->user()->image ? asset('storage/' . auth()->user()->image) : asset('images/default-profile.png') }}"
                                alt="Profile Image"
                                class="img-fluid rounded mb-3"
                                style="max-width: 200px; height: auto;">

                            <div class="mb-3">
                                <input type="file"
                                    name="image"
                                    class="form-control @error('image') is-invalid @enderror"
                                    accept="image/*">
                                @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label" style="color: #1b4332;">Shop Name</label>
                            <input type="text"
                                name="shop_name"
                                class="form-control @error('shop_name') is-invalid @enderror"
                                value="{{ old('shop_name', $shop->name) }}">
                            @error('shop_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="color: #1b4332;">Name</label>
                            <input type="text"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $seller->name) }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="color: #1b4332;">Phone</label>
                            <input type="text"
                                name="phone"
                                class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $seller->phone) }}">
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label" style="color: #1b4332;">Address</label>
                            <textarea name="address"
                                class="form-control @error('address') is-invalid @enderror"
                                rows="2">{{ old('address', $seller->address) }}</textarea>
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit"
                            class="btn text-white"
                            style="background-color: #1b4332;">
                            Update Profile
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection