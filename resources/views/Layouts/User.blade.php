<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Gita Ulos - @yield('title')</title>

    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
</head> 

@yield('scripts')
<body>

    @include('components.navbar')

    <main class="container py-4">
        @yield('content')
    </main>

    <footer class="bg-dark text-white p-4 mt-5">
        <div class="row">
            <div class="col-md-4">
                <h5>Gita Ulos</h5>
                <p>Menyediakan berbagai jenis ulos berkualitas dengan desain tradisional yang dijaga keasliannya.</p>
            </div>
            <div class="col-md-4">
                <h6>Tautan Cepat</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white">Beranda</a></li>
                    <li><a href="#" class="text-white">Produk</a></li>
                    <li><a href="#" class="text-white">Tentang Kami</a></li>
                    <li><a href="#" class="text-white">Kontak</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6>Kontak Kami</h6>
                <p>Jl. Sisingamangaraja No.123<br>Balige, Toba Samosir<br>Sumatera Utara, Indonesia</p>
                <p><i class="bi bi-telephone"></i> +62 812 3456 7890</p>
                <p><i class="bi bi-envelope"></i> Gitaulos@gmail.com</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
