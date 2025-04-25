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
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    
    <!-- Add Poppins font which is used in the footer -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Include the footer styles -->
    <style>
    /* Improved Footer Styling */
    .improved-footer {
        background-color: #1a1a1a;
        position: relative;
        color: #fff;
        overflow: hidden;
        font-family: 'Poppins', sans-serif;
    }

    /* Background Pattern */
    .footer-pattern {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M0 0h40v40H0V0zm40 40h40v40H40V40zm0-40h2l-2 2V0zm0 4l4-4h2l-6 6V4zm0 4l8-8h2L40 10V8zm0 4L52 0h2L40 14v-2zm0 4L56 0h2L40 18v-2zm0 4L60 0h2L40 22v-2zm0 4L64 0h2L40 26v-2zm0 4L68 0h2L40 30v-2zm0 4L72 0h2L40 34v-2zm0 4L76 0h2L40 38v-2zm0 4L80 0v2L42 40h-2zm4 0L80 4v2L46 40h-2zm4 0L80 8v2L50 40h-2zm4 0l28-28v2L54 40h-2zm4 0l24-24v2L58 40h-2zm4 0l20-20v2L62 40h-2zm4 0l16-16v2L66 40h-2zm4 0l12-12v2L70 40h-2zm4 0l8-8v2l-6 6h-2zm4 0l4-4v2l-2 2h-2z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        z-index: 0;
    }

    .improved-footer .container {
        position: relative;
        z-index: 1;
    }

    /* Logo Section */
    .footer-logos {
        margin-bottom: 20px;
    }

    .footer-main-logo,
    .footer-secondary-logo {
        height: 60px;
        width: auto;
        filter: brightness(1.2);
        transition: transform 0.4s ease;
    }

    .footer-main-logo:hover,
    .footer-secondary-logo:hover {
        transform: scale(1.08);
    }

    .footer-brand-name {
        font-size: 2.8rem;
        font-weight: 700;
        letter-spacing: 2px;
        margin-bottom: 15px;
        background: linear-gradient(45deg, #ff7b00, #ff9e00);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-transform: uppercase;
    }

    .footer-tagline-divider {
        height: 3px;
        width: 80px;
        background: linear-gradient(to right, transparent, #ff7b00, transparent);
        margin-bottom: 15px;
    }

    .footer-tagline {
        max-width: 600px;
        margin: 0 auto;
        color: #cccccc;
        font-size: 1.1rem;
    }

    /* Heading Styles */
    .footer-heading {
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 25px;
        position: relative;
        padding-bottom: 15px;
        color: #ffffff;
    }

    .footer-heading:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 3px;
        background: linear-gradient(to right, #ff7b00, #ff9e00);
        border-radius: 3px;
    }

    /* Menu Styles */
    .footer-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-menu li {
        margin-bottom: 15px;
    }

    .footer-menu a {
        color: #e0e0e0;
        text-decoration: none;
        display: flex;
        align-items: center;
        font-size: 1.05rem;
        transition: all 0.3s ease;
        padding: 3px 0;
    }

    .footer-menu a i {
        font-size: 18px;
        margin-right: 12px;
        color: #ff7b00;
        transition: all 0.3s ease;
    }

    .footer-menu a:hover {
        color: #ff9e00;
        transform: translateX(8px);
    }

    .footer-menu a:hover i {
        transform: scale(1.2);
    }

    /* Social Icons */
    .footer-social-icons {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
    }

    .social-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.1);
        color: #ffffff;
        font-size: 20px;
        transition: all 0.3s ease;
    }

    .social-icon:hover {
        background: linear-gradient(45deg, #ff7b00, #ff9e00);
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(255, 123, 0, 0.3);
    }

    /* Newsletter Section */
    .newsletter-title {
        font-size: 1.1rem;
        color: #e0e0e0;
        margin-bottom: 12px;
    }

    .newsletter-form .form-control {
        background-color: rgba(255, 255, 255, 0.1);
        border: none;
        color: #ffffff;
        padding: 12px 15px;
        height: auto;
    }

    .newsletter-form .form-control::placeholder {
        color: #aaaaaa;
    }

    .newsletter-form .form-control:focus {
        box-shadow: 0 0 0 2px rgba(255, 123, 0, 0.5);
        background-color: rgba(255, 255, 255, 0.15);
    }

    .btn-subscribe {
        background: linear-gradient(to right, #ff7b00, #ff9e00);
        border: none;
        color: #ffffff;
        padding: 0 20px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-subscribe:hover {
        background: linear-gradient(to right, #ff9e00, #ff7b00);
        transform: translateX(3px);
    }

    /* Contact Section */
    .contact-info {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
    }

    .contact-icon {
        width: 45px;
        height: 45px;
        min-width: 45px;
        background-color: rgba(255, 123, 0, 0.2);
        color: #ff7b00;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-right: 15px;
        transition: all 0.3s ease;
    }

    .contact-item:hover .contact-icon {
        background-color: #ff7b00;
        color: #ffffff;
        transform: rotate(360deg);
    }

    .contact-text p {
        margin: 0;
        color: #e0e0e0;
        line-height: 1.6;
    }

    /* Copyright Section */
    .footer-copyright {
        background-color: rgba(0, 0, 0, 0.3);
        padding: 20px 0;
        position: relative;
        z-index: 1;
    }

    .footer-copyright p {
        margin: 0;
        color: #aaaaaa;
        font-size: 0.95rem;
    }

    .footer-copyright a {
        color: #cccccc;
        text-decoration: none;
        transition: color 0.3s;
    }

    .footer-copyright a:hover {
        color: #ff9e00;
    }

    /* Responsive Adjustments */
    @media (max-width: 991.98px) {
        .footer-section {
            margin-bottom: 30px;
        }
        
        .footer-brand-name {
            font-size: 2.3rem;
        }
    }

    @media (max-width: 767.98px) {
        .footer-content {
            text-align: center;
        }
        
        .footer-heading:after {
            left: 50%;
            transform: translateX(-50%);
        }
        
        .footer-menu a {
            justify-content: center;
        }
        
        .footer-social-icons {
            justify-content: center;
        }
        
        .contact-item {
            flex-direction: column;
            align-items: center;
        }
        
        .contact-icon {
            margin-right: 0;
            margin-bottom: 15px;
        }
        
        .contact-text {
            text-align: center;
        }
        
        .footer-copyright p {
            text-align: center !important;
        }
        
        .footer-copyright .text-end {
            text-align: center !important;
            margin-top: 10px;
        }
    }

    /* Animation for elements */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .footer-section {
        animation: fadeInUp 0.5s ease forwards;
    }

    .footer-section:nth-child(2) {
        animation-delay: 0.2s;
    }

    .footer-section:nth-child(3) {
        animation-delay: 0.4s;
    }
    </style>
</head> 

<body>
    @include('components.customernavbar')

    <main class="container py-4">
        @yield('content')
    </main>

   
    <footer class="improved-footer">
        <div class="footer-pattern"></div>
        <div class="container py-5">
  
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <div class="footer-logos d-flex justify-content-center align-items-center gap-4 mb-3">
                        <img src="{{ asset('images/logodel.jpg') }}" alt="Gita Ulos Logo" class="footer-main-logo">
                        <img src="{{ asset('images/logo-secondary.png') }}" alt="Gita Ulos Secondary Logo" class="footer-secondary-logo">
                    </div>
                    <h2 class="footer-brand-name">GITA ULOS</h2>
                    <div class="footer-tagline-divider mx-auto"></div>
                    <p class="footer-tagline">Menyediakan berbagai jenis ulos berkualitas dengan desain tradisional yang dijaga keasliannya.</p>
                </div>
            </div>

            <div class="row footer-content g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-section">
                        <h4 class="footer-heading">Tautan Cepat</h4>
                        <ul class="footer-menu">
                            <li><a href="#"><i class="bi bi-house-door"></i> Beranda</a></li>
                            <li><a href="#"><i class="bi bi-shop"></i> Produk</a></li>
                            <li><a href="#"><i class="bi bi-info-circle"></i> Tentang Kami</a></li>
                            <li><a href="#"><i class="bi bi-envelope"></i> Kontak</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="footer-section">
                        <h4 class="footer-heading">Ikuti Kami</h4>
                        <div class="footer-social-icons">
                            <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-whatsapp"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-tiktok"></i></a>
                        </div>
                        
                
                <div class="col-lg-4 col-md-12">
                    <div class="footer-section">
                        <h4 class="footer-heading">Kontak Kami</h4>
                        <div class="contact-info">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                                <div class="contact-text">
                                    <p>Jl. Sisingamangaraja No.123<br>Balige, Toba Samosir<br>Sumatera Utara, Indonesia</p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="bi bi-telephone-fill"></i>
                                </div>
                                <div class="contact-text">
                                    <p>+62 812 3456 7890</p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="bi bi-envelope-fill"></i>
                                </div>
                                <div class="contact-text">
                                    <p>Gitaulos@gmail.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="footer-copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p>&copy; 2025 Gita Ulos. Hak Cipta Dilindungi.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>