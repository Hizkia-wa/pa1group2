@extends('layouts.User')

@section('content')

<!-- Hero Section -->
<div class="hero-header">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>Keindahan Budaya Batak Dalam Setiap Helai Ulos</h1>
        <p>Temukan koleksi Ulos terbaik dari Danau Toba, warisan budaya Indonesia yang ditenun dengan keahlian dan tradisi turun-temurun.</p>
        <div class="hero-buttons">
            <a href="#tentang" class="btn btn-secondary">Tentang Ulos</a>
        </div>
    </div>
</div>

<!-- Traditional Pattern Divider -->
<div class="traditional-pattern-divider"></div>



<div class="section-title-container" id="koleksi">
    <div class="section-decoration left"></div>
    <h2 class="section-title">Jenis Jenis Ulos Dan Kegunaannya</h2>
    <div class="section-decoration right"></div>
</div>




<div class="collection-section active" id="ulos-section">
    <div class="container">
        <div class="row collection-grid">
            @forelse($ulosData as $ulos)
            <div class="col-xl-4 col-lg-6 col-md-6 mb-4 collection-item">
                <div class="collection-card">
                    <div class="collection-card-media">
                        <img src="{{ asset('img/ulos/' . $ulos['image']) }}" alt="{{ $ulos['name'] }}" class="collection-img">
                        <div class="collection-hover-overlay">
                            
                        </div>
                    </div>
                    <div class="collection-card-body">
                        <h3 class="collection-card-title">{{ $ulos['name'] }}</h3>
                        <div class="collection-card-divider"></div>
                        <p class="collection-card-description">{{ Str::limit($ulos['short_description'], 100) }}</p>
                        <a href="{{ route('uloskita.detail', ['jenis' => $ulos['slug']]) }}" class="collection-card-btn">
                            Lihat Detail
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
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


</div>
<!-- Culture Info Section -->
<div class="info-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="info-content">
                    <h2>Warisan Budaya Yang Tak Ternilai</h2>
                    <p>Ulos adalah kain tenun tradisional yang berasal dari suku Batak di Sumatera Utara. Lebih dari sekadar kain, Ulos memiliki makna spiritual dan budaya yang mendalam, diwariskan dari generasi ke generasi.</p>
                    <p>Setiap motif dan warna pada Ulos memiliki filosofi tersendiri yang melambangkan harapan, doa, dan status sosial pemakainya.</p>
                    <ul class="info-list">
                        <li><i class="fas fa-check-circle"></i> Ditenun dengan teknik tradisional turun-temurun</li>
                        <li><i class="fas fa-check-circle"></i> Setiap jenis memiliki fungsi adat yang spesifik</li>
                        <li><i class="fas fa-check-circle"></i> Simbol status sosial dan identitas budaya Batak</li>
                        <li><i class="fas fa-check-circle"></i> Digunakan dalam berbagai upacara adat penting</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="info-image">
                    <img src="{{ asset('img/ulos/ulos_culture.jpg') }}" alt="Ulos Culture">
                    <div class="info-image-decoration"></div>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
</div>

<!-- Traditional Pattern Footer Divider -->
<div class="traditional-pattern-footer"></div>

<style>
:root {
    --primary-color: black;
    --primary-light: color: black;;
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

/* Hero Section */
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
    font-size: 3.5rem;
    font-weight: 700;
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

/* Category Tabs */
.categories-section {
    padding: 20px 0 40px;
}

.category-tabs {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 30px;
}

.category-tab {
    padding: 12px 30px;
    border: 2px solid var(--primary-color);
    border-radius: 50px;
    font-weight: 600;
    background-color: transparent;
    color: var(--primary-color);
    cursor: pointer;
    transition: var(--transition);
}

.category-tab:hover {
    background-color: rgba(123, 44, 191, 0.1);
}

.category-tab.active {
    background-color: var(--primary-color);
    color: var(--white);
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
    color: var(--primary-dark);
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
    border-radius: 12px;
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: var(--transition);
    background-color: var(--white);
    transform: translateY(0);
}

.collection-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(123, 44, 191, 0.15);
}

.collection-card-media {
    position: relative;
    height: 280px;
    overflow: hidden;
}

.collection-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
}

.collection-hover-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: var(--transition);
}

.collection-card:hover .collection-hover-overlay {
    opacity: 1;
}

.collection-card:hover .collection-img {
    transform: scale(1.1);
}

.collection-hover-content {
    text-align: center;
}

.collection-view-btn {
    display: inline-block;
    padding: 10px 25px;
    background-color: var(--secondary-color);
    color: var(--white);
    font-weight: 600;
    border-radius: 30px;
    transform: translateY(20px);
    opacity: 0;
    transition: all 0.4s ease;
}

.collection-card:hover .collection-view-btn {
    transform: translateY(0);
    opacity: 1;
}

.collection-card-body {
    padding: 25px;
}

.collection-card-title {
    color: var(--text-color);
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    position: relative;
    transition: var(--transition);
}

.collection-card-divider {
    width: 60px;
    height: 3px;
    background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
    margin-bottom: 15px;
}

.collection-card-description {
    color: var(--text-light);
    font-size: 1rem;
    line-height: 1.6;
    margin-bottom: 20px;
    height: 80px;
    overflow: hidden;
}

.collection-card-btn {
    display: inline-flex;
    align-items: center;
    color: var(--primary-color);
    font-weight: 600;
    text-decoration: none;
    padding: 8px 0;
    position: relative;
    transition: var(--transition);
}

.collection-card-btn::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background-color: var(--primary-color);
    transition: var(--transition);
}

.collection-card-btn i {
    margin-left: 8px;
    transition: var(--transition);
}

.collection-card-btn:hover {
    color: var(--secondary-color);
}

.collection-card-btn:hover::after {
    width: 100%;
    background-color: var(--secondary-color);
}

.collection-card-btn:hover i {
    transform: translateX(5px);
    color: var(--secondary-color);
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
    color: black;;
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
    
    .category-tab {
        padding: 10px 20px;
        font-size: 0.9rem;
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
    
    .category-tabs {
        gap: 10px;
    }
    
    .category-tab {
        padding: 8px 15px;
        font-size: 0.85rem;
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
        
        // Category tabs functionality
        const categoryTabs = document.querySelectorAll('.category-tab');
        const collectionSections = document.querySelectorAll('.collection-section');
        
        categoryTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs
                categoryTabs.forEach(t => t.classList.remove('active'));
                
                // Add active class to clicked tab
                this.classList.add('active');
                
                // Hide all collection sections
                collectionSections.forEach(section => {
                    section.classList.remove('active');
                });
                
                // Show the corresponding collection section
                const targetId = this.getAttribute('data-target') + '-section';
                document.getElementById(targetId).classList.add('active');
                
                // Update section title based on category
                const sectionTitle = document.querySelector('.section-title');
                switch(this.getAttribute('data-target')) {
                    case 'ulos':
                        sectionTitle.textContent = 'Koleksi Ulos Tradisional';
                        break;
                    case 'sortali':
                        sectionTitle.textContent = 'Koleksi Sortali Tradisional';
                        break;
                    case 'topi':
                        sectionTitle.textContent = 'Koleksi Topi Batak Tradisional';
                        break;
                    case 'mandar':
                        sectionTitle.textContent = 'Koleksi Mandar Tradisional';
                        break;
                }
            });
        });
    });
</script>
@endsection