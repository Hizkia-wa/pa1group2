<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm px-4">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center glowing-brand" href="{{ route('homeGuest') }}">
            <img src="{{ asset('img/ulos/logogita.png') }}" alt="Gita Ulos Logo" height="40" class="d-inline-block align-text-top me-2">
            <span class="brand-text">G𝓲𝓽𝓪 𝓤𝓵𝓸𝓼</span>
        </a>

        <!-- Tombol Hamburger untuk layar kecil -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu Navbar -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav flex-row-reverse gap-3 fw-semibold align-items-center">
                <li class="nav-item">
                    <a class="btn position-relative cart-icon-wrapper" href="{{ route('user.cart.index') }}">
                        <i class="bi bi-cart-fill cart-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('customer.uloskita') }}" class="nav-link nav-item-link {{ request()->routeIs('customer.uloskita') ? 'active' : '' }}">Ulos Kita</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('customer.reviews') }}" class="nav-link nav-item-link {{ request()->routeIs('user.reviews') ? 'active' : '' }}">Ulasan</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('customerprofil.umkm') }}" class="nav-link nav-item-link {{ request()->routeIs('profil.umkm') ? 'active' : '' }}">Profil</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('customer.catalog') }}" class="nav-link nav-item-link {{ request()->routeIs('customer.catalog') ? 'active' : '' }}">Produk</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('homeCustomer') }}" class="nav-link nav-item-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<style>
@import url('https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');

:root {
    --coklat-muda: #d2b48c;
    --coklat-tua: #8b5e3c;
    --krem-lembut: #f8f0e3;
    --highlight: #f2d2b1;
}

.cart-icon {
    font-size: 2rem;
    color: #ff6b00;
    transition: transform 0.3s ease, color 0.3s ease;
}

.cart-icon-wrapper:hover .cart-icon {
    color: #d9480f;
    transform: scale(1.2) rotate(-5deg);
}

.navbar-brand img {
    transition: transform 0.3s ease;
}

.navbar-brand:hover img {
    transform: scale(1.05);
}

.glowing-brand {
    font-size: 2rem;
    letter-spacing: 1px;
}

.glowing-brand:hover {
    transform: scale(1.05);
    text-shadow: 0 0 10px var(--coklat-tua);
}

/* Custom Nav Item */
.nav-item-link {
    color: #343a40;
    position: relative;
    padding: 0.5rem 1rem;
    transition: color 0.3s ease;
}

.nav-item-link:hover {
    color: var(--coklat-tua);
}

.nav-item-link.active {
    color: var(--coklat-tua);
    font-weight: bold;
}

.nav-item-link.active::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 100%;
    height: 2px;
    background-color: var(--coklat-tua);
}

/* Responsive Styles */
@media (max-width: 991px) {
    .navbar-nav {
        flex-direction: column-reverse !important;
        align-items: flex-end;
        gap: 0.75rem;
    }

    .navbar-nav .nav-item-link {
        padding: 1rem;
    }
}
</style>