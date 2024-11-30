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
        <form action="{{ route('user.cart.add') }}" method="POST" class="p-3">
            @csrf
            <input type="hidden" name="type" value="service">
            <input type="hidden" name="id" value="{{ $service->id }}">
            <input type="hidden" name="quantity" value="1">
            <div class="mb-2">
                <input type="datetime-local" 
                       class="form-control form-control-sm" 
                       name="start_date"
                       required
                       style="border: 1px solid #214F3E; border-radius: 6px;">
            </div>
            <div class="text-end">
                <button type="submit"
                    class="btn btn-sm"
                    style="background-color: #214F3E; color: white; border-radius: 6px;">
                    <i class="bi bi-cart-plus"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dateInputs = document.querySelectorAll('input[type="datetime-local"]');
    dateInputs.forEach(input => {
        const today = new Date();
        today.setMinutes(today.getMinutes() - today.getTimezoneOffset());
        input.min = today.toISOString().slice(0, 16);

        const maxDate = new Date();
        maxDate.setMonth(maxDate.getMonth() + 3);
        input.max = maxDate.toISOString().slice(0, 16);
    });
});
</script>