@extends('layouts.customer')

@section('content')

<!-- Hero Section -->
<div class="hero-header animate__fadeIn">
    <div class="hero-overlay"></div>
    <div class="hero-content animate__zoomIn" style="animation-delay: 0.2s;">
        <h1 class="animate__fadeInUp" style="animation-delay: 0.3s;">Keindahan Budaya Batak Dalam Setiap Helai Ulos</h1>
        <p class="animate__fadeInUp" style="animation-delay: 0.4s;">Temukan koleksi Ulos terbaik dari Danau Toba, warisan budaya Indonesia yang ditenun dengan keahlian dan tradisi turun-temurun.</p>
        <div class="hero-buttons animate__fadeInUp" style="animation-delay: 0.5s;">
        </div>
    </div>
</div>

<div class="traditional-pattern-divider animate__fadeIn" style="animation-delay: 0.6s;"></div>
<div class="section-title-container animate__fadeIn" id="koleksi">
    <div class="section-decoration left animate__fadeInLeft"></div>
    <h2 class="section-title animate__fadeInUp">Jenis Jenis Ulos Dan Kegunaannya</h2>
    <div class="section-decoration right animate__fadeInRight"></div>
</div>

<!-- Collection Grid -->
<div class="collection-section active animate__fadeIn" id="ulos-section">
    <div class="container">
        <div class="row collection-grid">
            @forelse($ulosData as $ulos)
            <div class="col-xl-3 col-lg-4 col-md-6 mb-3 collection-item animate__fadeInUp" style="animation-delay: {{ $loop->index * 0.2 }}s;">
                <div class="collection-card">
                    <div class="collection-card-media">
                        <img src="{{ asset('img/ulos/' . $ulos['image']) }}" alt="{{ $ulos['name'] }}" class="collection-img">
                        <div class="collection-hover-overlay"></div>
                    </div>
                    <div class="collection-card-body">
                        <h3 class="collection-card-title">{{ $ulos['name'] }}</h3>
                        <div class="collection-card-divider"></div>
                        <p class="collection-card-description">{{ Str::limit($ulos['short_description'], 80) }}</p>
                        <a href="{{ route('uloskita.detail', ['jenis' => $ulos['slug']]) }}" class="collection-card-btn">
                            Lihat Detail
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 animate__fadeInUp">
                <div class="empty-collection">
                    <div class="empty-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3>Koleksi Ulos akan segera hadir</h3>
                    <p>Kami sedang mempersiapkan koleksi terbaik untuk Anda. Silakan kembali lagi nanti.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Culture Info Section -->
<div class="info-section animate__fadeIn">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 animate__fadeInLeft">
                <div class="info-content">
                    <h2 class="animate__fadeInUp">Warisan Budaya Yang Tak Ternilai</h2>
                    <p class="animate__fadeInUp" style="animation-delay: 0.2s;">Ulos adalah kain tenun tradisional yang berasal dari suku Batak di Sumatera Utara. Lebih dari sekadar kain, Ulos memiliki makna spiritual dan budaya yang mendalam, diwariskan dari generasi ke generasi.</p>
                    <p class="animate__fadeInUp" style="animation-delay: 0.3s;">Setiap motif dan warna pada Ulos memiliki filosofi tersendiri yang melambangkan harapan, doa, dan status sosial pemakainya.</p>
                    <ul class="info-list">
                        <li class="animate__fadeInUp" style="animation-delay: 0.4s;"><i class="fas fa-check-circle"></i> Ditenun dengan teknik tradisional turun-temurun</li>
                        <li class="animate__fadeInUp" style="animation-delay: 0.5s;"><i class="fas fa-check-circle"></i> Setiap jenis memiliki fungsi adat yang spesifik</li>
                        <li class="animate__fadeInUp" style="animation-delay: 0.6s;"><i class="fas fa-check-circle"></i> Simbol status sosial dan identitas budaya Batak</li>
                        <li class="animate__fadeInUp" style="animation-delay: 0.7s;"><i class="fas fa-check-circle"></i> Digunakan dalam berbagai upacara adat penting</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 animate__fadeInRight">
                <div class="info-image">
                    <img src="{{ asset('img/ulos/uloskitaimage.png') }}" alt="Ulos Culture">
                    <div class="info-image-decoration"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="traditional-pattern-footer animate__fadeIn" style="animation-delay: 0.8s;"></div>

<style>
:root {
    --primary-color: black;
    --primary-light: black;
    --primary-dark: #5A189A;
    --secondary-color: #FF9E00;
    --secondary-light: #FFB700;
    --secondary-dark: #DB8400;
    --text-color: #333333;
    --text-light: #666666;
    --background-light: #F9F7FE;
    --white: #FFFFFF;
    --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    --transition: all 0.3s ease;
}

.hero-header {
    position: relative;
    height: 500px;
    background-image: url('{{ asset("img/ulos/backgroundhome.png") }}');
    background-size: cover;
    background-position: center;
    margin-bottom: 60px;
    display: flex;
    align-items: center;
}

.hero-overlay {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    background: rgba(255, 255, 255, 0.05);
}

.hero-content {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 20px;
    position: relative;
    z-index: 2;
    text-align: center;
    color: black;
}

.hero-content h1 {
    font-size: 3rem;
    font-weight: 600;
    margin-bottom: 20px;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
}

.hero-content p {
    font-size: 1.25rem;
    margin-bottom: 30px;
    font-weight: 400;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
}

.hero-buttons {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 30px;
}

.btn {
    display: inline-block;
    padding: 14px 32px;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: var(--transition);
}

.btn-primary {
    background-color: black;
    color: var(--white);
    border: none;
    box-shadow: 0 4px 15px rgba(255, 158, 0, 0.3);
}

.btn-primary:hover {
    background-color: var(--secondary-dark);
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(255, 158, 0, 0.4);
}

.btn-secondary {
    background-color: var(--primary-color);
    color: var(--white);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.btn-secondary:hover {
    background-color: var(--primary-dark);
    border-color: var(--white);
    transform: translateY(-3px);
}

/* Traditional Pattern Divider */
.traditional-pattern-divider {
    height: 40px;
    background-image: url('{{ asset("img/ulos/ulos_atakanta.jpg") }}');
    background-repeat: repeat-x;
    background-size: auto 100%;
    margin-bottom: 40px;
    position: relative;
}

.traditional-pattern-divider::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to right, rgba(0,0,0,0.1), transparent, rgba(0,0,0,0.1));
}

/* Section Title */
.section-title-container {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 50px;
    padding: 0 20px;
}

.section-decoration {
    height: 2px;
    flex: 1;
    max-width: 120px;
    background: linear-gradient(to right, transparent, var(--primary-color));
}

.section-decoration.right {
    background: linear-gradient(to left, transparent, var(--primary-color));
}

.section-title {
    color: black;
    font-size: 2.4rem;
    font-weight: 700;
    margin: 0 20px;
    text-align: center;
    position: relative;
}

/* Collection Sections */
.collection-section {
    padding: 0 0 60px;
    display: none;
}

.collection-section.active {
    display: block;
}

.collection-grid {
    position: relative;
}

.collection-card {
    position: relative;
    height: 100%;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.06);
    transition: var(--transition);
    background-color: var(--white);
    transform: translateY(0);
}

.collection-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(123, 44, 191, 0.12);
}

/* UPDATED IMAGE STYLES */
.collection-card-media {
    position: relative;
    height: 220px;
    overflow: hidden;
    background-color: #f5f5f5; /* Light background for empty space */
    display: flex;
    align-items: center;
    justify-content: center;
}

.collection-img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* This ensures the image covers the container area properly */
    object-position: center; /* Centers the image */
    transition: transform 0.5s ease;
}

.collection-card:hover .collection-img {
    transform: scale(1.05);
}

.collection-hover-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.1);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.collection-card:hover .collection-hover-overlay {
    opacity: 1;
}
/* END OF UPDATED IMAGE STYLES */

.collection-card-body {
    padding: 18px;
}

.collection-card-title {
    color: var(--text-color);
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 10px;
    position: relative;
    transition: var(--transition);
    line-height: 1.3;
}

.collection-card-divider {
    width: 50px;
    height: 2px;
    background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
    margin-bottom: 10px;
}

.collection-card-description {
    color: var(--text-light);
    font-size: 0.9rem;
    line-height: 1.5;
    margin-bottom: 15px;
    height: 60px;
    overflow: hidden;
}

.collection-card-btn {
    display: inline-flex;
    align-items: center;
    color: var(--primary-color);
    font-weight: 600;
    font-size: 0.9rem;
    text-decoration: none;
    padding: 5px 0;
    position: relative;
    transition: var(--transition);
}

.collection-card-btn:hover {
    color: var(--secondary-color);
    transform: translateX(5px);
}

/* Responsive adaptations */
@media (max-width: 1200px) {
    .collection-card-media {
        height: 200px;
    }
}

@media (max-width: 992px) {
    .collection-card-media {
        height: 180px;
    }
    
    .collection-card-title {
        font-size: 1.2rem;
    }
}

@media (max-width: 768px) {
    .col-md-6 {
        padding-left: 10px;
        padding-right: 10px;
    }
    
    .mb-4 {
        margin-bottom: 1rem !important;
    }
    
    .collection-card-media {
        height: 170px;
    }
    
    .collection-card-body {
        padding: 15px;
    }
}

@media (max-width: 576px) {
    .collection-card-media {
        height: 160px;
    }
    
    .collection-card-title {
        font-size: 1.1rem;
    }
    
    .collection-card-description {
        font-size: 0.85rem;
        height: 50px;
    }
}

/* Empty Collection */
.empty-collection {
    text-align: center;
    padding: 60px 20px;
    background-color: var(--background-light);
    border-radius: 12px;
    margin: 20px 0;
}

.empty-icon {
    font-size: 3rem;
    color: var(--primary-light);
    margin-bottom: 20px;
}

.empty-collection h3 {
    font-size: 1.8rem;
    color: var(--primary-dark);
    margin-bottom: 15px;
}

.empty-collection p {
    font-size: 1.1rem;
    color: var(--text-light);
    max-width: 600px;
    margin: 0 auto;
}

/* Info Section */
.info-section {
    padding: 80px 0;
    background-color: var(--background-light);
    position: relative;
    overflow: hidden;
}

.info-section::before {
    content: "";
    position: absolute;
    top: -50px;
    right: -50px;
    width: 200px;
    height: 200px;
    background-color: rgba(123, 44, 191, 0.05);
    border-radius: 50%;
}

.info-section::after {
    content: "";
    position: absolute;
    bottom: -100px;
    left: -100px;
    width: 300px;
    height: 300px;
    background-color: rgba(255, 158, 0, 0.05);
    border-radius: 50%;
}

.info-content {
    padding: 30px 0;
}

.info-content h2 {
    color: black;
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 25px;
}

.info-content p {
    color: var(--text-light);
    font-size: 1.1rem;
    line-height: 1.8;
    margin-bottom: 25px;
}

.info-list {
    list-style: none;
    padding: 0;
}

.info-list li {
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    color: var(--text-color);
    font-size: 1.05rem;
}

.info-list li i {
    color: var(--secondary-color);
    margin-right: 15px;
    font-size: 1.2rem;
}

.info-image {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: var(--shadow);
}

.info-image img {
    width: 100%;
    border-radius: 12px;
    transition: var(--transition);
}

.info-image:hover img {
    transform: scale(1.05);
}

.info-image-decoration {
    position: absolute;
    top: -20px;
    right: -20px;
    width: 120px;
    height: 120px;
    background-color: var(--primary-light);
    opacity: 0.15;
    border-radius: 50%;
    z-index: -1;
}

/* Traditional Pattern Footer */
.traditional-pattern-footer {
    height: 40px;
    background-image: url('{{ asset("img/ulos/pattern.png") }}');
    background-repeat: repeat-x;
    background-size: auto 100%;
    margin-top: 30px;
    position: relative;
}

.traditional-pattern-footer::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to right, rgba(0,0,0,0.1), transparent, rgba(0,0,0,0.1));
}

/* Responsive Styles */
@media (max-width: 1200px) {
    .collection-card-media {
        height: 240px;
    }
}

@media (max-width: 992px) {
    .hero-content h1 {
        font-size: 2.8rem;
    }
    
    .hero-content p {
        font-size: 1.15rem;
    }
    
    .section-title {
        font-size: 2.2rem;
    }
    
    .info-content h2 {
        font-size: 2rem;
        color: black;
    }
}

@media (max-width: 768px) {
    .hero-header {
        height: 500px;
    }
    
    .hero-content h1 {
        font-size: 2.2rem;
    }
    
    .hero-content p {
        font-size: 1.05rem;
    }
    
    .section-title {
        font-size: 1.8rem;
    }
    
    .section-decoration {
        max-width: 80px;
    }
    
    .info-image {
        margin-top: 40px;
    }
}

@media (max-width: 576px) {
    .hero-header {
        height: 450px;
    }
    
    .hero-content h1 {
        font-size: 1.8rem;
    }
    
    .hero-content p {
        font-size: 1rem;
    }
    
    .btn {
        padding: 12px 25px;
        font-size: 0.9rem;
    }
    
    .section-title {
        font-size: 1.6rem;
    }
    
    .section-decoration {
        max-width: 60px;
    }
    
    .collection-card-title {
        font-size: 1.3rem;
    }
    
    .collection-card-description {
        font-size: 0.95rem;
    }
    
    .info-content h2 {
        font-size: 1.7rem;
        color: black;
    }
    
    .info-content p {
        font-size: 1rem;
    }
}

/* Animasi dengan IntersectionObserver */
.animate__fadeIn, .animate__fadeInLeft, .animate__fadeInRight, .animate__fadeInUp, .animate__zoomIn {
    opacity: 0;
    transition: opacity 0.6s ease, transform 0.6s ease;
}

.animate__fadeIn.visible { opacity: 1; transform: translateY(0); }
.animate__fadeInLeft.visible { opacity: 1; transform: translateX(0); }
.animate__fadeInRight.visible { opacity: 1; transform: translateX(0); }
.animate__fadeInUp.visible { opacity: 1; transform: translateY(0); }
.animate__zoomIn.visible { opacity: 1; transform: scale(1); }

.animate__fadeInLeft { transform: translateX(-50px); }
.animate__fadeInRight { transform: translateX(50px); }
.animate__fadeInUp { transform: translateY(50px); }
.animate__zoomIn { transform: scale(0.8); }

/* Perkuat animasi existing */
.hero-header {
    transition: transform 0.3s ease;
}

.hero-header:hover {
    transform: scale(1.01);
}

.btn:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

.collection-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.collection-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(123, 44, 191, 0.2);
}

.collection-card-btn {
    transition: all 0.3s ease;
}

.collection-card-btn:hover {
    transform: translateX(8px);
    color: var(--secondary-dark);
}

.info-image {
    transition: transform 0.3s ease;
}

.info-image:hover {
    transform: scale(1.02);
}
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Intersection Observer untuk animasi saat scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.animate__fadeIn, .animate__fadeInLeft, .animate__fadeInRight, .animate__fadeInUp, .animate__zoomIn').forEach(element => {
        observer.observe(element);
    });
});
</script>
@endsection