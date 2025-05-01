<!-- resources/views/components/navbaradmin.blade.php -->
<nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm px-4 animate__animated animate__fadeInDown">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold glowing-brand" href="#">Gita Ulos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAdmin">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNavAdmin">
            <ul class="navbar-nav gap-4 align-items-center fw-bold">
                <li class="nav-item">
                    <a href="{{ route('homeGuest') }}" class="nav-link nav-cute {{ request()->routeIs('homeGuest') ? 'active' : '' }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.product.catalog') }}" class="nav-link nav-cute {{ request()->routeIs('user.product.catalog') ? 'active' : '' }}">Produk</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profil.umkm') }}" class="nav-link nav-cute {{ request()->routeIs('profil.umkm') ? 'active' : '' }}">Profil</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.reviews') }}" class="nav-link nav-cute {{ request()->routeIs('user.reviews') ? 'active' : '' }}">Ulasan</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('uloskita') }}" class="nav-link nav-cute {{ request()->routeIs('uloskita') ? 'active' : '' }}">Ulos Kita</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('homeAdmin') }}" class="nav-link nav-cute {{ request()->routeIs('homeAdmin') ? 'active' : '' }}">Admin</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-search fs-5 text-dark"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.cart.index') }}" class="nav-link position-relative">
                        <i class="bi bi-cart fs-5 text-dark"></i>
                    </a>
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

.glowing-brand {
    font-size: 2rem;
    letter-spacing: 1px;
}
.glowing-brand:hover {
    transform: scale(1.05);
    text-shadow: 0 0 10px var(--coklat-tua);
}

.nav-cute {
    transition: all 0.3s ease;
    border-radius: 0;
    color: #000;
    text-decoration: none;
    font-weight: 500;
}
.nav-cute:hover,
.nav-cute.active {
    border-bottom: 2px solid var(--coklat-tua);
    color: var(--coklat-tua);
    font-weight: bold;
}

@media (max-width: 991px) {
    .navbar-nav {
        flex-direction: column !important;
        align-items: flex-start;
        gap: 0.5rem;
    }
}
</style>
