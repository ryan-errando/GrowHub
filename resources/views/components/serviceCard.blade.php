<div class="col-md-4">
    <div class="card border-0 h-100" style="border-radius: 15px; overflow: hidden; background-color: #D1F2D9; position: relative;">
        <a href="{{ route('user.service.detail', $service->id)}}" class="text-decoration-none">
            <div style="background-color: #fce5cd; height: 250px;">
                <img src="{{ asset('storage/' . $service->image) }}"
                    class="img-fluid"
                    alt="{{ $service->name }}"
                    style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <div class="card-body">
                <h5 class="card-title" style="color: #214F3E; font-weight: 600;">
                    {{ $service->name }}
                </h5>
                <p class="card-text mb-1" style="color: #666;">
                    {{ $service->shop->name }}
                </p>
                <p class="card-text" style="color: #214F3E; font-weight: 600;">
                    Rp {{ number_format($service->price_per_hour, 0, ',', '.') }} / Hour
                </p>
            </div>
        </a>
        <form action="{{ route('user.cart.add') }}" method="POST" 
              style="position: absolute; bottom: 15px; right: 15px;">
            @csrf
            <input type="hidden" name="service_id" value="{{ $service->id }}">
            <input type="hidden" name="quantity" value="1">
            <button type="submit" 
                    class="btn btn-sm" 
                    style="background-color: #214F3E; color: white; border-radius: 6px;">
                <i class="bi bi-cart-plus"></i>
            </button>
        </form>
    </div>
</div>