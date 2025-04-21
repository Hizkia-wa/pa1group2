<!-- resources/views/components/navbar.blade.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm px-4">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">Gita Ulos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav flex-row-reverse gap-3 align-items-center fw-semibold">
                <!-- Login dan Cart -->
                <li class="nav-item">
                    <a class="btn btn-outline-dark me-2" href="#">Login</a>
                </li>
                <li class="nav-item">
                    <a class="btn" href="{{ route('user.cart.index') }}">
                        <i class="bi bi-cart"></i>
                    </a>
                </li>

                <!-- Menu Navigasi -->
                <li class="nav-item">
                    <a href="{{ route('uloskita') }}" class="nav-link {{ request()->routeIs('uloskita') ? 'active' : '' }}">Ulos Kita</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.reviews') }}" class="nav-link {{ request()->routeIs('user.reviews') ? 'active' : '' }}">Ulasan</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profil.umkm') }}" class="nav-link {{ request()->routeIs('profil.umkm') ? 'active' : '' }}">Profil</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
.navbar-nav .nav-link {
    padding: 0.5rem 1rem;
}
.navbar-nav .nav-item {
    display: flex;
    align-items: center;
}
.navbar-nav .btn {
    padding: 0.25rem 0.75rem;
}

/* Responsive - tumpuk navigasi di bawah di layar kecil */
@media (max-width: 991px) {
    .navbar-nav {
        flex-direction: column-reverse !important;
        align-items: flex-end;
    }
}
</style>
