<!-- resources/views/components/navbar.blade.php -->
<nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm px-4 animate__animated animate__fadeInDown">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold glowing-brand" href="#"> G𝓲𝓽𝓪 𝓤𝓵𝓸𝓼 </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav flex-row-reverse gap-3 align-items-center fw-semibold">
                <!-- Login dan Cart -->
                <li class="nav-item">
                    <a class="btn btn-outline-batik me-2 rounded-pill sparkle-button" href="#"> Login </a>
                </li>
                <li class="nav-item">
                    <a class="btn position-relative" href="{{ route('user.cart.index') }}">
                        <i class="bi bi-cart fs-5 text-dark"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-batik animate__animated animate__rubberBand">
                            3
                        </span>
                    </a>
                </li>

                <!-- Menu Navigasi -->
                <li class="nav-item">
                    <a href="{{ route('uloskita') }}" class="nav-link nav-cute {{ request()->routeIs('uloskita') ? 'active' : '' }}"> Ulos Kita</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.reviews') }}" class="nav-link nav-cute {{ request()->routeIs('user.reviews') ? 'active' : '' }}">💬 Ulasan</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profil.umkm') }}" class="nav-link nav-cute {{ request()->routeIs('profil.umkm') ? 'active' : '' }}">📜 Profil</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link nav-cute {{ request()->routeIs('home') ? 'active' : '' }}"> Beranda</a>
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
    font-family: 'Great Vibes', cursive;
    font-size: 2rem;
    color: var(--coklat-tua);
    text-shadow: 1px 1px 5px rgba(139, 94, 60, 0.3);
    letter-spacing: 1px;
    transition: transform 0.3s ease;
}
.glowing-brand:hover {
    transform: scale(1.05);
    text-shadow: 0 0 10px var(--coklat-tua);
}

/* Button Alay - Coklat Style */
.sparkle-button {
    transition: all 0.3s ease;
    border-color: var(--coklat-tua);
    color: var(--coklat-tua);
}
.sparkle-button:hover {
    background-color: var(--coklat-tua);
    color: #fff;
    transform: rotate(-1deg) scale(1.05);
}

/* Custom Outline */
.btn-outline-batik {
    border: 2px solid var(--coklat-tua);
    color: var(--coklat-tua);
}
.btn-outline-batik:hover {
    background-color: var(--coklat-tua);
    color: white;
}

/* Badge */
.bg-batik {
    background-color: var(--coklat-tua) !important;
}

/* Nav Item Gaya */
.nav-cute {
    transition: all 0.3s ease;
    border-radius: 8px;
    color: #343a40;
}
.nav-cute:hover,
.nav-cute.active {
    background-color: var(--krem-lembut);
    color: var(--coklat-tua);
    font-weight: bold;
    transform: scale(1.05);
}

/* Responsive */
@media (max-width: 991px) {
    .navbar-nav {
        flex-direction: column-reverse !important;
        align-items: flex-end;
        gap: 0.75rem;
    }
}
</style>
