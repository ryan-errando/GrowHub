@props(['activeMenu' => ''])

<div style="background-color: #f3f4f6; width: 16rem; min-height: 100vh; padding: 1rem;">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 1.5rem; font-weight: bold; color: #065f46;">GrowHub</h1>
    </div>
    
    <nav style="display: flex; flex-direction: column; gap: 0.5rem;">
        <a href="{{ route('seller.dashboard') }}" 
           style="display: flex; align-items: center; padding: 0.75rem; color: #065f46; border-radius: 0.5rem; text-decoration: none; transition: background-color 0.2s; {{ Str::contains($activeMenu, 'dashboard') ? 'background-color: rgba(6, 95, 70, 0.1);' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.75rem;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
            Profile
        </a>

        <a href="#" 
           style="display: flex; align-items: center; padding: 0.75rem; color: #065f46; border-radius: 0.5rem; text-decoration: none; transition: background-color 0.2s; {{ Str::contains($activeMenu, 'orders') ? 'background-color: rgba(6, 95, 70, 0.1);' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.75rem;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M9 17h6M9 13h6m2 8H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2z"/>
            </svg>
            Orders
        </a>

        <a href="{{ route('sellerProducts.create') }}" 
           style="display: flex; align-items: center; padding: 0.75rem; color: #065f46; border-radius: 0.5rem; text-decoration: none; transition: background-color 0.2s; {{ Str::contains($activeMenu, 'sellerProducts') ? 'background-color: rgba(6, 95, 70, 0.1);' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.75rem;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Add Product
        </a>

        <a href="{{ route('sellerServices.create') }}" 
           style="display: flex; align-items: center; padding: 0.75rem; color: #065f46; border-radius: 0.5rem; text-decoration: none; transition: background-color 0.2s; {{ Str::contains($activeMenu, 'sellerServices') ? 'background-color: rgba(6, 95, 70, 0.1);' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.75rem;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Add Service
        </a>

        <form method="POST" action="{{ route('logout') }}" style="margin-top: auto;">
            @csrf
            <button type="submit" 
                    style="display: flex; align-items: center; width: 100%; padding: 0.75rem; color: #065f46; border-radius: 0.5rem; border: none; background: none; cursor: pointer; transition: background-color 0.2s;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.75rem;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/>
                </svg>
                Logout
            </button>
        </form>
    </nav>
</div>