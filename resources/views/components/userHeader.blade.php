<nav class="navbar navbar-expand-md" style="background-color: #214F3E;">
  <div class="container">

    <a class="navbar-brand" href="/home" style="color: #B8E2CA; font-size: 1.5rem; font-weight: 500;">GrowHub</a>

    <!-- Navbar toggler for mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar items -->

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav align-items-center">
        @auth
        <li class="nav-item">
          <a class="nav-link me-4" href="/products" style="color: #B8E2CA;">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-4" href="/services" style="color: #B8E2CA;">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-4" href="/orderProducts" style="color: #B8E2CA;">Orders</a>
        </li>
        <li class="nav-item me-3">
          <a class="nav-link" href="/cart" style="color: #B8E2CA;">
            <i class="bi bi-bag fs-6"></i>
          </a>
        </li>
        <li class="nav-item me-3">
          <a class="nav-link" href="/profile" style="color: #B8E2CA;">
            <i class="bi bi-person-fill fs-4"></i>
          </a>
        </li>
        <li class="nav-item">
          <form action="{{ route('user.logout') }}" method="post" class="d-inline">
            @csrf
            <button type="submit" class="nav-link" style="background: none; border: none; color: #B8E2CA;">
              <i class="bi bi-box-arrow-right fs-5"></i>
            </button>
          </form>
        </li>
        @endauth 
      </ul>
    </div>
  </div>
</nav>