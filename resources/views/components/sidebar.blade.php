@props(['activeMenu' => ''])

<div style="background-color: #f3f4f6; width: 16rem; min-height: 100vh; padding: 1rem;">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 1.5rem; font-weight: bold; color: #065f46;">GrowHub</h1>
    </div>

    <nav style="display: flex; flex-direction: column; gap: 0.5rem;">
        <!-- Home/Dashboard -->
        <a href="{{ route('seller.dashboard') }}"
            class="d-flex align-items-center text-success text-decoration-none rounded-2 p-3 {{ Str::contains($activeMenu, 'dashboard') ? 'bg-success bg-opacity-10' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.75rem;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                <polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
            Home
        </a>

        <!-- Profile -->
        <a href="{{ route('seller.profile') }}"
            class="d-flex align-items-center text-success text-decoration-none rounded-2 p-3 {{ Str::contains($activeMenu, 'profile') ? 'bg-success bg-opacity-10' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.75rem;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
            Profile
        </a>

        <!-- Orders -->
        <a href="{{ route('seller.OrderProduct') }}"
            class="d-flex align-items-center text-success text-decoration-none rounded-2 p-3 {{ Request::is('sellerOrderProduct*') || Request::is('sellerOrderService*') ? 'bg-success bg-opacity-10' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.75rem;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M9 17h6M9 13h6m2 8H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2z"/>
            </svg>
            Orders
        </a>

        <!-- Add Product -->
        <a href="{{ route('sellerProducts.create') }}"
            class="d-flex align-items-center text-success text-decoration-none rounded-2 p-3 {{ Str::contains($activeMenu, 'sellerProducts') ? 'bg-success bg-opacity-10' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.75rem;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Add Product
        </a>

        <!-- Add Service -->
        <a href="{{ route('sellerServices.create') }}"
            class="d-flex align-items-center text-success text-decoration-none rounded-2 p-3 {{ Str::contains($activeMenu, 'sellerServices') ? 'bg-success bg-opacity-10' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.75rem;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Add Service
        </a>

        <!-- Logout -->
        <form method="POST" action="{{ route('seller.logout') }}" style="margin-top: auto;">
            @csrf
            <button type="submit"
                class="d-flex align-items-center text-success text-decoration-none rounded-2 p-3 w-100 border-0 bg-transparent">
                <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.75rem;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/>
                </svg>
                Logout
            </button>
        </form>
    </nav>
</div>