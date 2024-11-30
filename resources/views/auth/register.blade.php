@extends('layout.auth')
@section('title', 'Register')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-sm" style="width: 100%; max-width: 400px; background-color: #f5f5f5; border-radius: 20px; border: none;">
        <div class="card-body p-3 p-md-4">
            <h1 class="mb-4" style="font-weight: bold;">Register</h1>

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label" style="font-weight: 600;">Register as</label>
                    <select class="form-select" name="role" id="role" required
                        style="background-color: #D3D3D3; border: none; border-radius: 10px; padding: 10px;">
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        <option value="seller" {{ old('role') == 'seller' ? 'selected' : '' }}>Seller</option>
                    </select>
                    @error('role')
                    <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label" style="font-weight: 600;">Username</label>
                    <input class="form-control" type="text" id="name" name="name"
                        value="{{ old('name') }}" required
                        style="background-color: #D3D3D3; border: none; border-radius: 10px; padding: 10px;">
                    @error('name')
                    <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Shop details (only shown for sellers) -->
                <div id="shop-details" style="display: none;">
                    <div class="mb-3">
                        <label for="shop_name" class="form-label" style="font-weight: 600;">Shop Name</label>
                        <input class="form-control" type="text" id="shop_name" name="shop_name"
                            value="{{ old('shop_name') }}"
                            style="background-color: #D3D3D3; border: none; border-radius: 10px; padding: 10px;">
                        @error('shop_name')
                        <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label" style="font-weight: 600;">Email</label>
                    <input class="form-control" type="email" id="email" name="email"
                        value="{{ old('email') }}" required
                        style="background-color: #D3D3D3; border: none; border-radius: 10px; padding: 10px;">
                    @error('email')
                    <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3" id="address-field" style="display: none;">
                    <label for="address" class="form-label" style="font-weight: 600;">Address</label>
                    <input class="form-control" type="text" id="address" name="address"
                        value="{{ old('address') }}"
                        style="background-color: #D3D3D3; border: none; border-radius: 10px; padding: 10px;">
                    @error('address')
                    <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label" style="font-weight: 600;">Password</label>
                    <input class="form-control" type="password" id="password" name="password" required
                        style="background-color: #D3D3D3; border: none; border-radius: 10px; padding: 10px;">
                    @error('password')
                    <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label" style="font-weight: 600;">Confirm Password</label>
                    <input class="form-control" type="password" id="password_confirmation"
                        name="password_confirmation" required
                        style="background-color: #D3D3D3; border: none; border-radius: 10px; padding: 10px;">
                </div>

                <button type="submit" class="btn btn-success w-100 mb-3 py-2"
                    style="background-color: #6BAE75; border: none; border-radius: 10px; font-weight: 600;">Register</button>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-decoration-underline"
                        style="color: #000; font-weight: 500;">Login</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('role').addEventListener('change', function() {
        const shopDetails = document.getElementById('shop-details');
        const addressField = document.getElementById('address-field');
        const shopInputs = shopDetails.querySelectorAll('input, textarea');

        if (this.value === 'seller') {
            shopDetails.style.display = 'block';
            addressField.style.display = 'none';
            addressField.querySelector('input').required = false;
            shopInputs.forEach(input => input.required = true);
        } else {
            shopDetails.style.display = 'none';
            addressField.style.display = 'block';
            addressField.querySelector('input').required = true;
            shopInputs.forEach(input => {
                input.required = false;
                input.value = '';
            });
        }
    });

    // Initial state
    if (document.getElementById('role').value === 'seller') {
        document.getElementById('shop-details').style.display = 'block';
        document.getElementById('address-field').style.display = 'none';
    } else {
        document.getElementById('address-field').style.display = 'block';
    }
</script>

<style>
    .form-control:focus,
    .form-select:focus {
        box-shadow: none;
        border: 2px solid #75B798;
        background-color: #D3D3D3;
    }
</style>
@endsection