<div class="col-md-4">
    <a href="{{ route('user.service.detail', $service->id)}}" class="text-decoration-none">
        <div class="card border-0 h-100"
            style="border-radius: 15px; overflow: hidden; background-color: #D1F2D9;">
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
        </div>
    </a>
</div>