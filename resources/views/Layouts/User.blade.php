<!DOCTYPE html>
<html lang="id">
<head>
@vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <title>Gita Ulos - @yield('title')</title>

    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
</head> 


<body>
    @include('components.navbar')

    <main class="container py-4">
        @yield('content')
    </main>

    <footer class="bg-dark text-white p-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>Gita Ulos</h5>
                    <p>Menyediakan berbagai jenis ulos berkualitas dengan desain tradisional yang dijaga keasliannya.</p>
                    <div class="footer-logos">
                        <img src="{{ asset('img/ulos/logodel.jpg') }}" alt="Logo Gita Ulos" class="footer-logo me-3">
                        <img src="{{ asset('img/ulos/logogita.png') }}" alt="Logo Sertifikasi" class="footer-logo">
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <h6 class="footer-heading">Tautan Cepat</h6>
                    <ul class="list-unstyled footer-links">
                        <li><a href="{{ route('homeGuest') }}" class="footer-link"><i class="bi bi-house-door me-2"></i>Beranda</a></li>
                        <li><a href="{{ route('user.product.catalog') }}" class="footer-link"><i class="bi bi-bag me-2"></i>Produk</a></li>
                        <li><a href="{{ route('profil.umkm') }}" class="footer-link"><i class="bi bi-info-circle me-2"></i>profil</a></li>
                        <li><a href="{ route('user.reviews') }}" class="footer-link"><i class="bi bi-chat-dots me-2"></i>Ulasan</a></li>
                        <li><a href="{{ route('uloskita') }}" class="footer-link"><i class="bi bi-grid me-2"></i>Ulos Kita</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h6 class="footer-heading">Kontak Kami</h6>
                    <div class="contact-item">
                        <i class="bi bi-geo-alt"></i>
                        <p>Jl. Sisingamangaraja No.123<br>Balige, Toba Samosir<br>Sumatera Utara, Indonesia</p>
                    </div>
                    <div class="contact-item">
                        <i class="bi bi-telephone"></i>
                        <p>+62 812 3456 7890</p>
                    </div>
                    <div class="contact-item">
                        <i class="bi bi-envelope"></i>
                        <p>Gitaulos@gmail.com</p>
                    </div>
                    <div class="social-icons mt-3">
                        <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom text-center pt-3 mt-3 border-top border-secondary">
                <p class="mb-0">&copy; 2025 Gita Ulos. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>



    <style>

footer {
    background: linear-gradient(135deg, #1c2331 0%, #121921 100%) !important;
    box-shadow: 0 -5px 15px rgba(0,0,0,0.1);
    position: relative;
    overflow: hidden;
}

footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 3px;
    background: linear-gradient(90deg, #ff9966, #ff5e62, #8062D6, #6A5BE2);
}

.footer-heading {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1.25rem;
    position: relative;
    padding-bottom: 0.75rem;
}

.footer-heading::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 2px;
    background-color: #6A5BE2;
}

.footer-links li {
    margin-bottom: 12px;
    transition: transform 0.3s;
}

.footer-links li:hover {
    transform: translateX(5px);
}

.footer-link {
    color: #e0e0e0;
    text-decoration: none;
    transition: color 0.3s;
    display: inline-block;
}

.footer-link:hover {
    color: #8062D6;
}

.contact-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 15px;
}

.contact-item i {
    color: #8062D6;
    margin-right: 15px;
    font-size: 1.1rem;
    margin-top: 3px;
}

.contact-item p {
    margin: 0;
    line-height: 1.5;
}

.social-icons {
    display: flex;
    gap: 15px;
}

.social-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background-color: rgba(255,255,255,0.1);
    color: white;
    transition: all 0.3s;
}

.social-icon:hover {
    background-color: #8062D6;
    transform: translateY(-3px);
    color: white;
}

.footer-logos {
    display: flex;
    align-items: center;
    margin-top: 20px;
    
}

.footer-logo {
    height: 60px;
    width: auto;
    object-fit: contain;
    border-radius: 5px;
   
}

.footer-logo:hover {
    filter: brightness(1) invert(0);
    transform: scale(1.05);
}

.footer-bottom {
    font-size: 0.9rem;
    opacity: 0.8;
}

@media (max-width: 767px) {
    .footer-logos {
        justify-content: center;
        margin-bottom: 20px;
    }
    
    .footer-heading {
        text-align: center;
    }
    
    .footer-heading::after {
        left: 50%;
        transform: translateX(-50%);
    }
    
    .contact-item {
        justify-content: center;
    }
    
    .social-icons {
        justify-content: center;
    }
}
        </style>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    @yield('scripts')
</body>


</html>
