@extends('layout.user')

@section('title', 'Service | ' . $service->name)

@section('content')
<div class="container py-5">
    <!-- Back Button -->
    <a href="{{ url()->previous() }}" class="text-decoration-none mb-4 d-inline-block">
        <i class="bi bi-arrow-left fs-4" style="color: #214F3E;"></i>
    </a>

    <div class="row mt-4">
        <!-- service Info -->
        <div class="col-lg-6">
            <h1 class="display-4 mb-3" style="color: #214F3E; font-weight: bold;">
                {{ $service->name }}
            </h1>

            <h2 class="mb-4" style="color: #214F3E; font-weight: bold;">
                Rp {{ number_format($service->price_per_hour, 0, ',', '.') }} / Hour
            </h2>

            <div class="mb-5">
                <p class="lead" style="color: #333; line-height: 1.8;">
                    {{ $service->description }}
                </p>
            </div>

            <!-- Quantity and Add to Cart -->
            <form action="{{ route('user.cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="service">
                <input type="hidden" name="id" value="{{ $service->id }}">

                <!-- Add DateTime Picker -->
                <div class="mb-4">
                    <label for="start_date" class="form-label" style="color: #214F3E; font-weight: 600;">Select Date and Time</label>
                    <input type="datetime-local"
                        class="form-control"
                        id="start_date"
                        name="start_date"
                        required
                        style="border-radius: 8px; border: 1px solid #214F3E;">
                </div>

                <div class="d-flex align-items-center gap-4">
                    <div class="quantity-selector d-flex align-items-center"
                        style="background-color: #214F3E; border-radius: 8px;">
                        <button type="button" class="btn px-3 py-2"
                            onclick="updateQuantity(-1)"
                            style="color: white;">-</button>
                        <input type="number"
                            id="quantity"
                            name="quantity"
                            value="1"
                            min="1"
                            class="form-control text-center border-0"
                            style="width: 60px; background: none; color: white;">
                        <button type="button" class="btn px-3 py-2"
                            onclick="updateQuantity(1)"
                            style="color: white;">+</button>
                    </div>

                    <button type="submit" class="btn px-4 py-2 flex-grow-1"
                        style="background-color: #214F3E; color: white; border-radius: 8px;">
                        Add to cart
                    </button>
                </div>
            </form>
        </div>

        <!-- service Image -->
        <div class="col-lg-6">
            <div class="p-3" style="background-color: #fce5cd; border-radius: 20px;">
                <img src="{{ asset('storage/' . $service->image) }}"
                    alt="{{ $service->name }}"
                    class="img-fluid rounded-3"
                    style="width: 100%; height: auto; object-fit: cover;">
            </div>
        </div>
    </div>
</div>

<script>
    function updateQuantity(change) {
        const input = document.getElementById('quantity');
        const newValue = parseInt(input.value) + change;
        if (newValue >= 1) {
            input.value = newValue;
        }
    }

    document.getElementById('quantity').addEventListener('change', function() {
        if (this.value < 1) {
            this.value = 1;
        }
    });
</script>

<style>
    .quantity-selector input::-webkit-outer-spin-button,
    .quantity-selector input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .quantity-selector input[type=number] {
        -moz-appearance: textfield;
        appearance: textfield;
    }

    .btn:hover {
        opacity: 0.9;
    }

    .quantity-selector button:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
</style>
@endsection