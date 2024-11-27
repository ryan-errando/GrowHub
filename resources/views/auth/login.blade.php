@extends('layout.auth')
@section('title', 'Login')

@section('content')

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert"> 
    {{ session('success') }} 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
    </button>
</div>
@endif

@if(session()->has('loginError'))
<div class="alert alert-danger alert-dismissible fade show" role="alert"> 
    {{ session('loginError') }} 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
    </button>
</div>
@endif

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-sm" style="width: 100%; max-width: 400px; background-color: #f5f5f5; border-radius: 20px; border: none;">
        <div class="card-body p-3 p-md-4">
            <h1 class="mb-4" style="font-weight: bold;">Login</h1>
            
            <form action="/login" method="post">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label" style="font-weight: 600;">Email</label>
                    <input name="email" 
                           type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           id="email" 
                           placeholder="name@example.com" 
                           required 
                           value="{{ old('email') }}"
                           style="background-color: #D3D3D3; border: none; border-radius: 10px; padding: 10px;">
                    @error('email')
                    <div class="text-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label" style="font-weight: 600;">Password</label>
                    <input name="password" 
                           type="password" 
                           class="form-control" 
                           id="password" 
                           required
                           style="background-color: #D3D3D3; border: none; border-radius: 10px; padding: 10px;">
                </div>

                <button type="submit" 
                        class="btn btn-success w-100 mb-3 py-2" 
                        style="background-color: #6BAE75; border: none; border-radius: 10px; font-weight: 600;">Login</button>
                
                <div class="text-center">
                    <a href="{{ route('register') }}" 
                       class="text-decoration-underline" 
                       style="color: #000; font-weight: 500;">Register</a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.form-control:focus {
    box-shadow: none;
    border: 2px solid #75B798;
    background-color: #D3D3D3;
}

.invalid-feedback {
    color: #dc3545;
}
</style>

@endsection