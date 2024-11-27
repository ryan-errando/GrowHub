<div class="col-md-4">
    <a href="{{ route('user.product.detail', $product->id)}}" class="text-decoration-none">
        <div class="card border-0 h-100"
            style="border-radius: 15px; overflow: hidden; background-color: #D1F2D9;">
            <div style="background-color: #fce5cd; height: 250px;">
                <img src="{{ asset('storage/' . $product->image) }}"
                    class="img-fluid"
                    alt="{{ $product->name }}"
                    style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <div class="card-body">
                <h5 class="card-title" style="color: #214F3E; font-weight: 600;">
                    {{ $product->name }}
                </h5>
                <p class="card-text mb-1" style="color: #666;">
                    {{ $product->shop->name }}
                </p>
                <p class="card-text" style="color: #214F3E; font-weight: 600;">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </p>
            </div>
        </div>
    </a>
</div>