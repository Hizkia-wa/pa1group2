<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm px-4">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">Gita Ulos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav flex-row-reverse gap-3 fw-semibold align-items-center">
                <!-- Ikon profil, cart, search -->
                <li class="nav-item">
                    <a href="#">
                        <img src="{{ asset('images/profile-user.png') }}" alt="Profile" class="rounded-circle" width="32" height="32">
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.cart.index') }}" class="text-dark fs-5"><i class="bi bi-cart"></i></a>
                </li>
                <li class="nav-item">
                    <a href="#" class="text-dark fs-5"><i class="bi bi-search"></i></a>
                </li>

                <!-- Menu navigasi -->
                <li class="nav-item">
                    <a href="{{ route('uloskita') }}" class="nav-link {{ request()->routeIs('uloskita') ? 'text-dark text-decoration-underline' : '' }}">Ulos Kita</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.reviews') }}" class="nav-link {{ request()->routeIs('user.reviews') ? 'text-dark text-decoration-underline' : '' }}">Ulasan</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profil.umkm') }}" class="nav-link {{ request()->routeIs('profil.umkm') ? 'text-dark text-decoration-underline' : '' }}">Profil</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.index') ? 'text-dark text-decoration-underline' : '' }}">Produk</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'text-dark text-decoration-underline' : '' }}">Beranda</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
