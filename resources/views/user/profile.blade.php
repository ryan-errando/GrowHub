@extends('layout.user')

@section('title', 'Profile')

@section('content')
<div class="container py-5">
    <h1 class="mb-5" style="color: #214F3E;">Profile</h1>

    <!-- Profile Picture Section -->
    <div class="text-center mb-5">
        <div class="mx-auto mb-3" style="width: 150px; height: 150px; border-radius: 50%; background-color: #f5f5f5; overflow: hidden;">
            @if(Auth::user()->profile_picture)
            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                alt="Profile Picture"
                class="img-fluid"
                style="width: 100%; height: 100%; object-fit: cover;">
            @else
            <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                <i class="bi bi-person-fill" style="font-size: 4rem; color: #214F3E;"></i>
            </div>
            @endif
        </div>
        <h2 class="mb-2" style="color: #214F3E;">{{ Auth::user()->name }}</h2>
        <p class="text-muted">{{ Auth::user()->email }}</p>
    </div>


    <!-- Profile Form -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <!-- prof pic -->
                <div class="mb-4">
                    <label class="form-label" style="color: #214F3E;">Profile Picture</label>
                    <input type="file"
                        class="form-control @error('profile_picture') is-invalid @enderror"
                        name="profile_picture"
                        style="border-radius: 8px; border: 1px solid #214F3E;">
                    @error('profile_picture')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Name -->
                <div class="mb-3">
                    <label class="form-label" style="color: #214F3E;">Name</label>
                    <input type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        name="name"
                        value="{{ old('name', Auth::user()->name) }}"
                        style="border-radius: 8px; border: 1px solid #214F3E;">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Address -->
                <div class="mb-4">
                    <label class="form-label" style="color: #214F3E;">Address</label>
                    <input type="text"
                        class="form-control @error('address') is-invalid @enderror"
                        name="address"
                        value="{{ old('address', Auth::user()->address) }}"
                        style="border-radius: 8px; border: 1px solid #214F3E;">
                    @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label" style="color: #214F3E;">New Password</label>
                    <input type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        name="password"
                        style="border-radius: 8px; border: 1px solid #214F3E;">
                    <small class="text-muted">Leave empty if you don't want to change password</small>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Confirmation -->
                <div class="mb-4">
                    <label class="form-label" style="color: #214F3E;">Confirm New Password</label>
                    <input type="password"
                        class="form-control"
                        name="password_confirmation"
                        style="border-radius: 8px; border: 1px solid #214F3E;">
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit"
                        class="btn px-4 py-2"
                        style="background-color: #214F3E; color: white; border-radius: 8px;">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@if(session('success'))
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header" style="background-color: #214F3E; color: white;">
            <strong class="me-auto">Success</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ session('success') }}
        </div>
    </div>
</div>
@endif
@endsection