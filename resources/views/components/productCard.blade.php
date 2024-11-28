<div class="col-md-4">
    <div class="card border-0 h-100" style="border-radius: 15px; overflow: hidden; background-color: #D1F2D9; position: relative;">
        <a href="{{ route('user.product.detail', $product->id)}}" class="text-decoration-none">
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
        </a>
        <form action="{{ route('user.cart.add') }}" method="POST" 
              style="position: absolute; bottom: 15px; right: 15px;">
            @csrf
            <input type="hidden" name="type" value="product">
            <input type="hidden" name="id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="1">
            <button type="submit" 
                    class="btn btn-sm" 
                    style="background-color: #214F3E; color: white; border-radius: 6px;">
                <i class="bi bi-cart-plus"></i>
            </button>
        </form>
    </div>
</div>