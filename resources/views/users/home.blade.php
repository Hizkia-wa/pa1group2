@extends('layouts.User')

@section('content')
<div class="container-fluid p-0">
    <!-- Hero Section -->
    <div class="hero-section text-center py-5 bg-light">
        <div class="container">
            <h1 class="display-4 fw-bold">Keindahan Budaya Batak Dalam Setiap Helai Ulos</h1>
            <p class="lead">Temukan koleksi Ulos terbaik dari Danau Toba, warisan budaya Indonesia yang ditemun dengan keahlian dan tradisi turun-temurun.</p>
            <a href="{{ route('user.product.catalog') }}" class="btn btn-primary mt-3">Lihat Koleksi</a>
            <a href="{{ route('uloskita') }}" class="btn btn-outline-secondary mt-3 ms-2">Tentang Ulos</a>
        </div>
    </div>

    <!-- Featured Products Section -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Ulos Pilihan Terbaik</h2>
        <p class="text-center mb-5">Karya seni tradisional Batak pilihan dengan keahlian tinggi, memadukan budaya Indonesia yang kaya.</p>
        
        <div class="row">
            @forelse($bestSellerProducts as $product)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    @if($product->ImageMain)
                    <img src="{{ asset('storage/' . $product->ImageMain) }}" class="card-img-top" alt="{{ $product->ProductName }}" loading="lazy">
                    @else
                    <img src="{{ asset('images/no-image.jpg') }}" class="card-img-top" alt="No Image Available" loading="lazy">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->ProductName }}</h5>
                        <p class="card-text small">{{ Str::limit($product->Description, 50) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-danger">Rp {{ number_format($product->Price, 0, ',', '.') }}</span>
                            <a href="{{ route('product.detail', $product->id) }}" class="btn btn-sm btn-primary">Keranjang</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p>Belum ada produk unggulan saat ini.</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Culture Section with Image -->
    <div class="container my-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2>Warisan Budaya yang Ditenun dengan Cinta</h2>
                <p>Ulos telah menjadi simbol identitas Batak selama berabad-abad, merupakan simbol berkat, perlindungan dan kehangatan yang diterapkan secara fisik maupun spiritual. Proses pembuatan setiap helai ulos memerlukan keahlian tinggi, kesabaran, dan membutuhkan waktu yang lama hingga berhari-hari, diwariskan dari generasi ke generasi.</p>
                <p>Gita Ulos hadir untuk melestarikan warisan budaya dengan menawarkan koleksi ulos yang dikerjakan oleh para pengrajin ulos dan penenun tradisional asli Batak di sekitar Danau Toba, yang secara metode telah dipelajari langsung dari generasi sebelumnya. Dengan teknik tradisional yang diadaptasi dengan perkembangan modern, kami tetap mempertahankan nilai budaya yang telah ada selama ratusan tahun serta memberikan wawasan budaya yang tak ternilai kepada semua pelanggan kami.</p>
                <a href="{{ route('uloskita') }}" class="btn btn-primary">Baca Selengkapnya</a>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('img/ulos/partonun.jpeg') }}" class="img-fluid rounded" alt="Pengrajin Ulos" loading="lazy">
            </div>
        </div>
    </div>

    <!-- Making Process -->
    <div class="container my-5 process-section">
        <h2 class="text-center mb-5">Proses Pembuatan Ulos</h2>
        <div class="row text-center">
            <div class="col-md-3 process-item">
                <div class="position-relative mb-4">
                    <div class="process-circle bg-warning d-flex align-items-center justify-content-center mx-auto">
                        <span class="fs-4 fw-bold">1</span>
                    </div>
                </div>
                <h5>Pemilihan Benang</h5>
                <p class="small">Memilih benang berkualitas tinggi dengan warna dan tekstur yang tepat</p>
            </div>
            <div class="col-md-3 process-item">
                <div class="position-relative mb-4">
                    <div class="process-circle bg-warning d-flex align-items-center justify-content-center mx-auto">
                        <span class="fs-4 fw-bold">2</span>
                    </div>
                </div>
                <h5>Pewarnaan Alami</h5>
                <p class="small">Menggunakan pewarna alami dari tanaman untuk mendapatkan warna khas</p>
            </div>
            <div class="col-md-3 process-item">
                <div class="position-relative mb-4">
                    <div class="process-circle bg-warning d-flex align-items-center justify-content-center mx-auto">
                        <span class="fs-4 fw-bold">3</span>
                    </div>
                </div>
                <h5>Proses Tenun</h5>
                <p class="small">Menenun dengan teknik tradisional menggunakan alat tradisional</p>
            </div>
            <div class="col-md-3 process-item">
                <div class="position-relative mb-4">
                    <div class="process-circle bg-warning d-flex align-items-center justify-content-center mx-auto">
                        <span class="fs-4 fw-bold">4</span>
                    </div>
                </div>
                <h5>Finishing</h5>
                <p class="small">Tahap akhir dengan detail dan sentuhan sempurna</p>
            </div>
        </div>
    </div>

    <!-- Customer Reviews -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Apa Kata Pelanggan Gita Ulos?</h2>
        
        <div class="row">
            @forelse($testimonials as $review)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex mb-3 align-items-center">
                            <div class="avatar me-3 bg-light rounded-circle text-center" style="width: 50px; height: 50px; line-height: 50px;">
                                <i class="bi bi-person"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">{{ $review->ReviewerName }}</h6>
                                <div class="text-warning">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->Rating)
                                            <i class="bi bi-star-fill"></i>
                                        @else
                                            <i class="bi bi-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <small class="text-muted">{{ $review->created_at->format('d M Y') }}</small>
                            </div>
                        </div>
                        <p class="card-text">{{ Str::limit($review->Comment, 150) }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p>Belum ada ulasan saat ini.</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Apakah ada pertanyaan seputar produk kami?</h2>
        <p class="text-center mb-4">Tim kami siap membantu. Anda dapat menghubungi kami terkait semua kebutuhan. Kami juga menerima pesanan khusus dengan desain ulos tersendiri.</p>
        
        <div class="row align-items-center">
            <div class="col-md-8">
                <a href="https://wa.me/+628123456789" class="btn btn-success btn-lg">
                    <i class="bi bi-whatsapp me-2"></i> Hubungi Kami Melalui WhatsApp
                </a>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('img/ulos/ulos-atakanta.jpg') }}" class="img-fluid rounded" alt="Contoh Ulos" loading="lazy">
            </div>
        </div>
    </div>

    <!-- Location & Contact -->
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <h3>Lokasi & Kontak Kami</h3>
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.1268481704317!2d98.6734735!3d3.5889271!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30312f94c65f63dd%3A0xf9a21acec1195170!2sMedan%2C%20Kota%20Medan%2C%20Sumatera%20Utara!5e0!3m2!1sid!2sid!4v1650123456789!5m2!1sid!2sid" 
                        width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Telepon & WhatsApp</h5>
                        <p><i class="bi bi-telephone me-2"></i> +62 812 3456 7890</p>
                        
                        <h5 class="card-title mb-4 mt-4">Email</h5>
                        <p><i class="bi bi-envelope me-2"></i> info@gitaulos.com</p>
                        
                        <h5 class="card-title mb-4 mt-4">Jam Buka</h5>
                        <p>
                            Senin - Jumat: 08:00 - 17:00<br>
                            Sabtu: 09:00 - 15:00<br>
                            Minggu: Tutup
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.page-loader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #fff;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: opacity 0.5s ease;
}

.page-loader.loaded {
    opacity: 0;
    pointer-events: none;
}

.loader {
    width: 50px;
    height: 50px;
    border: 5px solid #f3f3f3;
    border-top: 5px solid var(--primary-color, #6a1b9a);
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.custom-cursor {
    position: fixed;
    width: 10px;
    height: 10px;
    background-color: var(--primary-color, #6a1b9a);
    border-radius: 50%;
    pointer-events: none;
    z-index: 9999;
    opacity: 0.5;
    transform: translate(-50%, -50%);
    transition: width 0.3s, height 0.3s, opacity 0.3s;
}

.custom-cursor.expanded {
    width: 30px;
    height: 30px;
    opacity: 0.2;
}

@media (max-width: 768px) {
    .custom-cursor {
        display: none;
    }
    
    body, a, button, .card, .process-item {
        cursor: auto;
    }
}

.card.active {
    z-index: 2;
    transform: scale(1.05);
    transition: transform 0.3s ease;
}

.card.faded {
    opacity: 0.7;
    transition: opacity 0.3s ease;
}

.process-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.active-process .process-circle {
    background-color: var(--primary-color, #6a1b9a) !important;
    transform: scale(1.2);
}

.process-circle.pulse {
    animation: processHighlight 1.5s infinite;
}

@keyframes processHighlight {
    0% { box-shadow: 0 0 0 0 rgba(106, 27, 154, 0.7); }
    70% { box-shadow: 0 0 0 15px rgba(106, 27, 154, 0); }
    100% { box-shadow: 0 0 0 0 rgba(106, 27, 154, 0); }
}

.animate-on-scroll {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.8s ease, transform 0.8s ease;
}

.animate-on-scroll.animated {
    opacity: 1;
    transform: translateY(0);
}

.hero-section {
    background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('img/ulos/backgroundhome.png') }}');
    background-size: cover;
    background-position: center;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Page loader
    const pageLoader = document.createElement('div');
    pageLoader.className = 'page-loader';
    pageLoader.innerHTML = '<div class="loader"></div>';
    document.body.appendChild(pageLoader);
    
    setTimeout(function() {
        pageLoader.classList.add('loaded');
        setTimeout(() => pageLoader.remove(), 500);
    }, 800);

    // Animation on scroll
    const sections = document.querySelectorAll('.container-fluid > div');
    sections.forEach((section, index) => {
        section.classList.add('animate-on-scroll');
        section.style.animationDelay = `${index * 0.1}s`;
    });

    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Product card effects
    const productCards = document.querySelectorAll('.card');
    productCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.classList.add('active');
            productCards.forEach(other => {
                if (other !== this) {
                    other.classList.add('faded');
                }
            });
        });
        
        card.addEventListener('mouseleave', function() {
            this.classList.remove('active');
            productCards.forEach(other => {
                other.classList.remove('faded');
            });
        });
    });

    // Parallax effect
    const heroSection = document.querySelector('.hero-section');
    if (heroSection) {
        window.addEventListener('scroll', function() {
            const scrollPosition = window.scrollY;
            if (scrollPosition < 600) {
                const offset = scrollPosition * 0.4;
                heroSection.style.backgroundPositionY = `${offset}px`;
            }
        });
    }

    // Intersection Observer
    const animatedElements = document.querySelectorAll('.animate-on-scroll');
    if ('IntersectionObserver' in window) {
        const animationObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                    animationObserver.unobserve(entry.target);
                }
            });
        }, {threshold: 0.15, rootMargin: '0px 0px -100px 0px'});
        
        animatedElements.forEach(element => {
            animationObserver.observe(element);
        });
    } else {
        animatedElements.forEach(element => {
            element.classList.add('animated');
        });
    }

    // Process section animation
    const processSection = document.querySelector('.process-section');
    if (processSection) {
        const processItems = processSection.querySelectorAll('.process-item');
        let activeIndex = 0;
        
        function highlightProcess(index) {
            processItems.forEach((item, i) => {
                if (i === index) {
                    item.classList.add('active-process');
                    item.querySelector('.process-circle').classList.add('pulse');
                } else {
                    item.classList.remove('active-process');
                    item.querySelector('.process-circle').classList.remove('pulse');
                }
            });
        }
        
        highlightProcess(0);
        
        let processInterval = setInterval(() => {
            activeIndex = (activeIndex + 1) % processItems.length;
            highlightProcess(activeIndex);
        }, 3000);
        
        processSection.addEventListener('mouseenter', () => {
            clearInterval(processInterval);
        });
        
        processItems.forEach((item, index) => {
            item.addEventListener('mouseenter', () => {
                highlightProcess(index);
                activeIndex = index;
            });
        });
        
        processSection.addEventListener('mouseleave', () => {
            processInterval = setInterval(() => {
                activeIndex = (activeIndex + 1) % processItems.length;
                highlightProcess(activeIndex);
            }, 3000);
        });
    }

    // Custom cursor
    if (window.innerWidth > 768) {
        const customCursor = document.createElement('div');
        customCursor.className = 'custom-cursor';
        document.body.appendChild(customCursor);
        
        const interactiveElements = document.querySelectorAll('a, button, .card, .process-item');
        
        interactiveElements.forEach(element => {
            element.addEventListener('mouseenter', () => {
                customCursor.classList.add('expanded');
            });
            
            element.addEventListener('mouseleave', () => {
                customCursor.classList.remove('expanded');
            });
        });
        
        document.addEventListener('mousemove', (e) => {
            customCursor.style.left = `${e.clientX}px`;
            customCursor.style.top = `${e.clientY}px`;
        });
    }
});
</script>
@endsection