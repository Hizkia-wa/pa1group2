<!-- resources/views/components/navbar.blade.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm px-4">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">Gita Ulos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Ulasan</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('uloskita') }}" class="nav-link {{ request()->routeIs('uloskita') ? 'active' : '' }}">Ulos Kita</a>
                </li>
            </ul>
            <div>
                <a class="btn btn-outline-dark me-2" href="#">Login</a>
                <a class="btn" href="#"><i class="bi bi-cart"></i></a>
            </div>
        </div>
    </div>
</nav>
