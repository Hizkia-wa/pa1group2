<!-- resources/views/components/navbaradmin.blade.php -->
<nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm px-4 animate__animated animate__fadeInDown">
    <div class="container-fluid">
         <a class="navbar-brand d-flex align-items-center glowing-brand" href="{{ route('homeGuest') }}">
            <img src="{{ asset('img/ulos/logogita.png') }}" alt="Gita Ulos Logo" height="40" class="d-inline-block align-text-top me-2">
            <span class="brand-text">G𝓲𝓽𝓪 𝓤𝓵𝓸𝓼</span>
        </a>


        <div class="collapse navbar-collapse justify-content-end" id="navbarNavAdmin">
            <ul class="navbar-nav gap-4 align-items-center fw-bold">
                <li class="nav-item">
                    <a href="{{ route('homeAdmin') }}" class="nav-link nav-cute {{ request()->routeIs('homeAdmin') ? 'active' : '' }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.catalog') }}" class="nav-link nav-cute {{ request()->routeIs('admin.catalog') ? 'active' : '' }}">Produk</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('adminprofil.umkm') }}" class="nav-link nav-cute {{ request()->routeIs('adminprofil.umkm') ? 'active' : '' }}">Profil</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('adminuser.reviews') }}" class="nav-link nav-cute {{ request()->routeIs('adminuser.reviews') ? 'active' : '' }}">Ulasan</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.uloskita') }}" class="nav-link nav-cute {{ request()->routeIs('admin.uloskita') ? 'active' : '' }}">Ulos Kita</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.homepage') }}" class="nav-link nav-cute {{ request()->routeIs('admin.homepage') ? 'active' : '' }}">Admin</a>
                </li>
               
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
