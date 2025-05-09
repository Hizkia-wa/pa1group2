<nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm px-4 animate__animated animate__fadeInDown">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center glowing-brand" href="{{ route('homeGuest') }}">
            <img src="{{ asset('img/ulos/logogita.png') }}" alt="Gita Ulos Logo" height="40" class="d-inline-block align-text-top me-2">
            <span class="brand-text">G𝓲𝓽𝓪 𝓤𝓵𝓸𝓼</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>






        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav flex-row-reverse gap-3 align-items-center fw-semibold">
                <!-- Login dan Cart -->
                <li class="nav-item">
                    <a class="btn btn-outline-batik me-2 rounded-pill sparkle-button" href="{{ route('login') }} ">
                        <i class="bi bi-person-fill me-1"></i> Login
                    </a>
                </li>
                <li class="nav-item">
                    <a class="btn position-relative cart-icon-wrapper" href="{{ route('login') }}">
                        <i class="bi bi-cart-fill cart-icon"></i>
                    
                            
                        </span>
                    </a>
                </li>
                
                <!-- Menu Navigasi -->
                <li class="nav-item">
                    <a href="{{ route('uloskita') }}" class="nav-link nav-item-link {{ request()->routeIs('uloskita') ? 'active' : '' }}"> Ulos Kita</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.reviews') }}" class="nav-link nav-item-link {{ request()->routeIs('user.reviews') ? 'active' : '' }}">Ulasan</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profil.umkm') }}" class="nav-link nav-item-link {{ request()->routeIs('profil.umkm') ? 'active' : '' }}">Profil</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.product.catalog') }}" class="nav-link nav-item-link {{ request()->routeIs('user.product.catalog') ? 'active' : '' }}">Produk</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('homeGuest') }}" class="nav-link nav-item-link {{ request()->routeIs('home') ? 'active' : '' }}"> Beranda</a>
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




/* Warna dan animasi ikon keranjang */
.cart-icon {
    font-size: 2 rem;
    color: #ff6b00;
    transition: transform 0.3s ease, color 0.3s ease;
}

.cart-icon-wrapper:hover .cart-icon {
    color: #d9480f; 
    transform: scale(1.2) rotate(-5deg);
}


.cart-badge {
    background: linear-gradient(45deg, #d9480f, #ffa94d);
    color: white;
    font-size: 0.7rem;
    padding: 2px 6px;
    box-shadow: 0 0 5px rgba(0,0,0,0.2);
    border: 1px solid white;
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

/* Nav Item Gaya - Modifikasi untuk garis bawah active */
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

/* Garis di bawah untuk active */
.nav-item-link.active::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 100%;
    height: 2px;
    background-color: var(--coklat-tua);
}

/* Responsive */
@media (max-width: 991px) {
    .navbar-nav {
        flex-direction: column-reverse !important;
        align-items: flex-end;
        gap: 0.75rem;
    }
    
    .nav-item-link.active::after {
        bottom: -5px;
    }
}
</style>