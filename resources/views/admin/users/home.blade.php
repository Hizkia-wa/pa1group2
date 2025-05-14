@extends('layouts.useradmin')

@section('content')

<div class="hero-header animate__fadeIn">
    <div class="hero-image-container">
        <img src="{{ asset('img/imagehome.jpg') }}" alt="Gambar Budaya Batak" class="hero-image animate__zoomIn">
    </div>
    <div class="hero-content animate__slideInUp">
    </div>
</div>

<div class="container my-5 animate__fadeIn">
    <h2 class="text-center mb-4 animate__fadeIn">Ulos Pilihan Terbaik</h2>
    <p class="text-center mb-4 animate__fadeIn" style="animation-delay: 0.2s;">Karya seni tradisional Batak pilihan dengan keahlian tinggi, memadukan budaya Indonesia yang kaya.</p>
    
    <div class="position-relative">
        <div class="scroll-nav d-md-block d-none">
            <button class="scroll-btn scroll-left" aria-label="Scroll left">
                <i class="bi bi-chevron-left"></i>
            </button>
            <button class="scroll-btn scroll-right" aria-label="Scroll right">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>
        
        <div class="products-scroll-container">
            <div class="products-scroll-wrapper">
                @forelse($bestSellerProducts as $product)
                <div class="product-card-wrapper animate__zoomIn" style="animation-delay: {{ $loop->index * 0.1 }}s;">
                    <div class="card product-card">
                        @php
                            $images = json_decode($product->Images, true);
                            $mainImage = !empty($images) ? $images[0] : null;
                        @endphp
                        
                        <div class="product-image-container">
                            @if($mainImage)
                                <img src="{{ asset('storage/' . $mainImage) }}" class="card-img-top product-image" alt="{{ $product->ProductName }}" loading="lazy">
                            @else
                                <img src="{{ asset('images/no-image.jpg') }}" class="card-img-top product-image" alt="No Image Available" loading="lazy">
                            @endif
                        </div>

                        <div class="card-body p-3">
                            <a href="{{ route('user.product.detail', ['id' => $product->id]) }}" style="color: maroon; text-decoration: none;">
                                <h5 class="card-title">{{ $product->ProductName }}</h5>
                            </a>
                            <p class="card-text small mb-2 product-desc">{{ Str::limit($product->Description, 40) }}</p>
                            <div class="mt-2">
                                <p class="fw-bold text-danger mb-2">Rp {{ number_format($product->Price, 0, ',', '.') }}</p>
                                <div class="d-flex product-buttons">
                                    <a href="{{ route('login') }}" class="btn btn-primary flex-grow-1 me-2">Beli</a>
                                    <a href="{{ route('login') }}" class="btn-cart">
                                        <i class="bi bi-cart-plus"></i> Keranjang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p>Tidak ada produk terlaris saat ini</p>
                </div>
                @endforelse
            </div>
        </div>
        
        <div class="scroll-indicator">
            <div class="scroll-dots"></div>
        </div>
    </div>
</div>

<section class="heritage-section py-5" style="background: #f9f9f9;">
    <div class="container animate__animated animate__fadeIn">
        <div class="custom-heritage-card p-4 p-md-5 rounded-4 shadow-lg d-flex flex-column flex-md-row align-items-center gap-4">
            
            <!-- Gambar -->
            <div class="heritage-img-container flex-shrink-0">
                <img src="{{ asset('img/ulos/uloskitaimage.png') }}" class="img-fluid rounded-4" alt="Pengrajin Ulos">
            </div>

            <!-- Konten Teks -->
            <div class="heritage-content text-center text-md-start">
                <h2 class="fw-bold mb-3" style="color: #8B0000;">Warisan Budaya yang Ditenun dengan Cinta</h2>
                <p>
                    Ulos adalah simbol budaya Batak yang menyimbolkan berkat, perlindungan, dan kehangatan. Proses pembuatannya diwariskan dari generasi ke generasi dan membutuhkan kesabaran serta keahlian tinggi.
                </p>
                <p>
                    Gita Ulos hadir untuk menjaga warisan ini tetap hidup, dengan menghadirkan koleksi ulos buatan tangan oleh para penenun asli di sekitar Danau Toba. Perpaduan tradisi dan modernitas ini membawa makna budaya kepada setiap pelanggan kami.
                </p>
                <a href="{{ route('uloskita') }}" class="btn btn-lg mt-3 px-4 py-2 shadow rounded-pill text-white" style="background-color: #8B0000;">
                    Baca Selengkapnya
                </a>
            </div>

        </div>
    </div>
</section>



<!-- Making Process -->
<div class="container my-5 process-section animate__fadeIn">
    <h2 class="text-center mb-5 animate__fadeIn">Proses Pembuatan Ulos</h2>
    <div class="row text-center">
        <div class="col-md-3 process-item animate__fadeInUp" style="animation-delay: 0s;">
            <div class="position-relative mb-4">
                <div class="process-circle bg-warning d-flex align-items-center justify-content-center mx-auto">
                    <span class="fs-4 fw-bold">1</span>
                </div>
            </div>
            <h5>Pemilihan Benang</h5>
            <p class="small">Memilih benang berkualitas tinggi dengan warna dan tekstur yang tepat</p>
        </div>
        <div class="col-md-3 process-item animate__fadeInUp" style="animation-delay: 0.2s;">
            <div class="position-relative mb-4">
                <div class="process-circle bg-warning d-flex align-items-center justify-content-center mx-auto">
                    <span class="fs-4 fw-bold">2</span>
                </div>
            </div>
            <h5>Pewarnaan Alami</h5>
            <p class="small">Menggunakan pewarna alami dari tanaman untuk mendapatkan warna khas</p>
        </div>
        <div class="col-md-3 process-item animate__fadeInUp" style="animation-delay: 0.4s;">
            <div class="position-relative mb-4">
                <div class="process-circle bg-warning d-flex align-items-center justify-content-center mx-auto">
                    <span class="fs-4 fw-bold">3</span>
                </div>
            </div>
            <h5>Proses Tenun</h5>
            <p class="small">Menenun dengan teknik tradisional menggunakan alat tradisional</p>
        </div>
        <div class="col-md-3 process-item animate__fadeInUp" style="animation-delay: 0.6s;">
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

<!-- Customer Reviews with Horizontal Scroll -->
<div class="container my-5 animate__fadeIn">
    <h2 class="text-center mb-4 animate__fadeIn">Apa Kata Pelanggan Gita Ulos?</h2>
    
    <div class="position-relative">
        <div class="scroll-nav d-md-block d-none">
            <button class="scroll-btn scroll-left reviews-scroll-left" aria-label="Scroll left">
                <i class="bi bi-chevron-left"></i>
            </button>
            <button class="scroll-btn scroll-right reviews-scroll-right" aria-label="Scroll right">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>
        
        <div class="reviews-scroll-container">
            <div class="reviews-scroll-wrapper">
                @forelse($testimonials as $review)
                <div class="review-card-wrapper animate__zoomIn" style="animation-delay: {{ $loop->index * 0.1 }}s;">
                    <div class="card testimonial-card h-100">
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
                            <p class="card-text testimonial-text">{{ $review->Comment }}</p>
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
        
        <div class="scroll-indicator reviews-scroll-indicator">
            <div class="scroll-dots reviews-scroll-dots"></div>
        </div>
    </div>
</div>

<div class="custom-contact-box my-5 p-4 p-md-5 rounded-4 shadow-lg bg-white position-relative animate__fadeIn">
    <div class="row align-items-center">
        <div class="col-md-8 animate__fadeInLeft">
            <h3 class="fw-bold mb-3 text-dark">Masih Bingung Soal Produk Kami?</h3>
            <p class="mb-4 text-muted">
                Kami siap membantu Anda menemukan Ulos terbaik sesuai kebutuhan. Bisa juga request desain atau ukuran spesial.
            </p>
            <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-wa-custom d-inline-flex align-items-center">
                <i class="bi bi-whatsapp me-2 fs-5"></i> Chat WhatsApp Sekarang
            </a>
        </div>
        <div class="col-md-4 text-center text-md-end mt-4 mt-md-0 animate__fadeInRight">
            <img src="{{ asset('img/ulos/ulos-atakanta.jpg') }}" 
                 class="img-fluid rounded-4 shadow-sm custom-contact-img" 
                 alt="Contoh Ulos" 
                 style="max-height: 260px; object-fit: cover;">
        </div>
    </div>
</div>

<!-- Location & Contact -->
<div class="container my-5 animate__fadeIn">
    <h3 class="text-center mb-5 fw-bold text-primary animate__fadeIn">📍 Lokasi & Kontak Kami</h3>
    <div class="row g-4 align-items-stretch">
        <div class="col-md-6 animate__fadeInLeft">
            <div class="shadow rounded-4 overflow-hidden">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.201663504994!2d99.15515687592641!3d2.4397623975392104!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3031ffc56771a24b%3A0x52c629ec1d6260d1!2sGITA%20ULOS!5e0!3m2!1sid!2sid!4v1746016363635!5m2!1sid!2sid" 
                    width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                    class="rounded-4 w-100">
                </iframe>
            </div>
        </div>
        <div class="col-md-6 animate__fadeInRight">
            <div class="card shadow rounded-4 h-100">
                <div class="card-body p-4">
                    <h5 class="mb-3 text-dark fw-semibold"><i class="bi bi-telephone-fill me-2 text-success"></i>Telepon & WhatsApp</h5>
                    <p class="ms-4">+62 812 3456 7890</p>
                    <h5 class="mb-3 mt-4 text-dark fw-semibold"><i class="bi bi-envelope-fill me-2 text-danger"></i>Email</h5>
                    <p class="ms-4">info@gitaulos.com</p>
                    <h5 class="mb-3 mt-4 text-dark fw-semibold"><i class="bi bi-clock-fill me-2 text-warning"></i>Jam Buka</h5>
                    <ul class="ms-4 mb-0 list-unstyled">
                        <li>Senin - Jumat: 08:00 - 17:00</li>
                        <li>Sabtu: 09:00 - 15:00</li>
                        <li>Minggu: <span class="text-muted">Tutup</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .custom-heritage-card {
    background: linear-gradient(
        135deg,
        rgba(139, 0, 0, 0.05),
        rgba(255, 255, 255, 0.85)
    );
    backdrop-filter: blur(5px);
    border: 1px solid rgba(139, 0, 0, 0.1);
    transition: transform 0.4s ease, box-shadow 0.4s ease;
}

.custom-heritage-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
}

.heritage-img-container {
    max-width: 420px;
    width: 100%;
    overflow: hidden;
    border-radius: 1.5rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    position: relative;
    transition: transform 0.5s ease;
}

.heritage-img-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease, filter 0.5s ease;
    border-radius: 1.5rem;
}

.heritage-img-container:hover img {
    transform: scale(1.05);
    filter: brightness(1.1) contrast(1.1);
}

.heritage-content p {
    color: #333;
    font-size: 1.05rem;
    line-height: 1.7;
}

.custom-card-bg {
    background: linear-gradient(
        135deg,
        rgba(139, 0, 0, 0.1),  
        rgba(255, 255, 255, 0.9) 
    );
    backdrop-filter: blur(4px);
    border: 1px solid rgba(139, 0, 0, 0.15);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease;
}

.custom-card-bg:hover {
    transform: translateY(-4px);
}
.custom-soft-btn {
    background-color:rgb(221, 91, 91); 
    color: #fff;
    border: none;
    transition: background-color 0.3s ease, transform 0.2s;
}

.custom-soft-btn:hover {
    background-color: #a94442;
    transform: scale(1.03);
}
.image-container {
    position: relative;
    overflow: hidden;
    border-radius: 1.5rem;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
    transition: transform 0.5s ease, box-shadow 0.5s ease;
    background: linear-gradient(135deg, #fff, #f3f3f3);
    transform-style: preserve-3d;
    perspective: 1000px;
}

.image-container::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('{{ asset("img/patterns/ulos-pattern.png") }}'); 
    background-size: cover;
    opacity: 0.07;
    z-index: 2;
    pointer-events: none;
}

.image-container:hover {
    transform: scale(1.03) rotateX(3deg) rotateY(-3deg);
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
}

.image-container img {
    width: 100%;
    height: auto;
    object-fit: cover;
    border-radius: 1.5rem;
    transition: transform 0.6s ease;
    z-index: 1;
    position: relative;
}

.image-container:hover img {
    transform: scale(1.08);
    filter: brightness(1.05) contrast(1.1);
}


.btn:active {
    transform: scale(0.98); 
    background-color: #6A0000; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
    transition: transform 0.2s ease, background-color 0.2s ease, box-shadow 0.2s ease; 
}


.btn:focus {
    outline: none; 
    background-color:rgb(242, 12, 12); 
    box-shadow: 0 0 10pxrgb(36, 4, 4); 
    transition: background-color 0.2s ease; 
}


.custom-contact-box {
    background: linear-gradient(135deg, #fdfdfd, #f7faff);
    border-left: 8px solid #28a745;
}

.btn-wa-custom {
    background-color: #25D366;
    color: white;
    padding: 12px 24px;
    font-size: 1rem;
    font-weight: 500;
    border-radius: 50px;
    box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
    transition: all 0.3s ease-in-out;
    text-decoration: none;
}

.btn-wa-custom:hover {
    background-color: #1ebe5d;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(37, 211, 102, 0.5);
}

.custom-contact-img:hover {
    transform: scale(1.03);
    transition: 0.3s ease;
}

.btn-cart {
    background-color: white;
    color: #8B0000; 
    border: 2px solid #8B0000;
    gap: 4px;
    height: 40px;
    border-radius: 5px;
    text-decoration: none;
    padding-top: 5px;
    padding-right: 10px;
    padding-left: 10px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.btn-cart:hover {
    background-color: #8B0000;
    color: white;
}


.form-cart {
    width: 100%;
    display: flex;
}

:root {
    --primary-color: #800000; 
    --secondary-color: #8B0000; 
    --accent-color: #B22222; 
    --text-color: #212121; 
    --text-secondary: #666; 
    --text-light: #ffffff; 
    --danger-color: #dc3545; 
    --success-color: #28a745; 
    --light-gray: #f3f4f6; 
    --lighter-gray: #f9f9f9; 
    --border-color: #eaeaea; 
    --shadow-light: rgba(0, 0, 0, 0.05); 
    --shadow-medium: rgba(0, 0, 0, 0.1); 
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

.custom-culture-image {
    max-width: 500%; 
    max-height: 500%;           
    border-radius: 50px;      
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); 
    margin-right: -100%;         
}

.product-card {
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid #eaeaea;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    height: 100%;
    max-width: 250px;
    margin: 0 auto;
    text-decoration: none;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0,0,0,0.1);
}

.product-image-container {
    height: 200px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f9f9f9;
}

.product-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.product-card:hover .product-image {
    transform: scale(1.05);
}

.product-desc {
    height: 40px;
    overflow: hidden;
    color: #666;
}

.product-buttons {
    gap: 5px;
    text-decoration: none;
}

.keranjang-btn {
    white-space: nowrap;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    padding-top: 5px;
    padding-right: 5px;
    padding-left: 5px;
}

.card-title {
    text-decoration: none;
    color: inherit;
}

.testimonial-card {
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid #eaeaea;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    height: 100%;
}

.testimonial-text {
    max-height: none;
    overflow: visible;
}

.custom-wa-img {
    max-width: 100%;
    border-radius: 20px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.custom-contact-box {
    background-color: #f3f4f6; 
    border-radius: 20px;
}

.custom-contact-img {
    max-width: 100%;
    border-radius: 12px;
    object-fit: cover;
}

.process-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.active-process .process-circle {
    background: linear-gradient(135deg, #8B0000, #FFFFFF) !important; 
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

.hero-image-container {
    text-align: center;
    margin-top: 10px; 
    margin-bottom:10px; 
}

.hero-image {
    max-width: 1500px;
    width: 100%;
    height: auto;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    transition: transform 0.4s ease, box-shadow 0.4s ease;
}

.hero-section {
    background: url("{{ asset('img/ulos/background.png') }}");
    background-size: cover;
    background-position: center;
    padding: 5rem 0;
    color: white;
}

.products-scroll-container,
.reviews-scroll-container {
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none; /* IE and Edge */
    position: relative;
    padding: 10px 0;
}

.products-scroll-container::-webkit-scrollbar,
.reviews-scroll-container::-webkit-scrollbar {
    display: none; 
}

.products-scroll-wrapper,
.reviews-scroll-wrapper {
    display: flex;
    gap: 20px;
    transition: transform 0.3s ease;
    padding: 0 10px;
}

.product-card-wrapper,
.review-card-wrapper {
    flex: 0 0 auto;
    transition: transform 0.3s ease;
}

.product-card-wrapper {
    width: 250px;
}

.review-card-wrapper {
    width: calc(100% / 3 - 20px); 
}

.scroll-nav {
    position: absolute;
    width: 100%;
    top: 50%;
    left: 0;
    z-index: 2;
    transform: translateY(-50%);
    pointer-events: none;
}

.scroll-btn {
    position: absolute;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: white;
    border: none;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    pointer-events: auto;
    opacity: 0.7;
}

.scroll-btn:hover {
    opacity: 1;
    transform: scale(1.1);
}

.scroll-btn.scroll-left,
.scroll-btn.reviews-scroll-left {
    left: -20px;
}

.scroll-btn.scroll-right,
.scroll-btn.reviews-scroll-right {
    right: -20px;
}

.scroll-indicator,
.reviews-scroll-indicator {
    width: 100%;
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.scroll-dots,
.reviews-scroll-dots {
    display: flex;
    gap: 8px;
}

.dot {
    width: 8px;
    height: 8px;
    background-color: #ddd;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.dot.active {
    width: 16px;
    border-radius: 4px;
    background-color: var(--primary-color, #6a1b9a);
}

@media (max-width: 992px) {
    .review-card-wrapper {
        width: calc(50% - 20px);
    }
}

@media (max-width: 768px) {
    .product-card-wrapper {
        width: 200px;
    }
    
    .review-card-wrapper {
        width: 80%; 
    }
    
    .products-scroll-container,
    .reviews-scroll-container {
        padding: 0;
        margin: 0 -15px;
        width: calc(100% + 30px);
    }
    
    .products-scroll-wrapper,
    .reviews-scroll-wrapper {
        padding: 0 15px;
    }

    background-repeat: no-repeat;
    padding: 100px 0;
    text-align: center;
    color: white;
    font-size: 20px;
    font-weight: 500;
    width: 100%; 
    height: 400px; 
    object-fit: cover; 
    filter: none; 
    position: relative;
}

.hero-content {
    transform: none;
    bottom: auto;
    left: auto;
    text-align: center;
    margin-top: 20px; 
}

.btn-primary:hover {
    background-color: #2563eb; 
}

.hero-buttons {
    margin-left: 3%;
}

/* Animasi dengan IntersectionObserver */
.animate__fadeIn, .animate__fadeInLeft, .animate__fadeInRight, .animate__fadeInUp, .animate__zoomIn, .animate__slideInUp {
    opacity: 0;
    transition: opacity 0.6s ease, transform 0.6s ease;
}

.animate__fadeIn.visible { opacity: 1; transform: translateY(0); }
.animate__fadeInLeft.visible { opacity: 1; transform: translateX(0); }
.animate__fadeInRight.visible { opacity: 1; transform: translateX(0); }
.animate__fadeInUp.visible { opacity: 1; transform: translateY(0); }
.animate__zoomIn.visible { opacity: 1; transform: scale(1); }
.animate__slideInUp.visible { opacity: 1; transform: translateY(0); }

.animate__fadeInLeft { transform: translateX(-50px); }
.animate__fadeInRight { transform: translateX(50px); }
.animate__fadeInUp { transform: translateY(50px); }
.animate__zoomIn { transform: scale(0.8); }
.animate__slideInUp { transform: translateY(100px); }

/* Perkuat animasi existing */
.product-card {
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 12px 20px rgba(0,0,0,0.15);
}

.product-image {
    transition: transform 0.5s ease;
}

.product-card:hover .product-image {
    transform: scale(1.1);
}

.testimonial-card {
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.testimonial-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 12px 20px rgba(0,0,0,0.15);
}

.hero-image {
    transition: transform 0.4s ease, box-shadow 0.4s ease;
}

.hero-image:hover {
    transform: scale(1.03);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
}

.custom-contact-box {
    transition: transform 0.3s ease;
}

.custom-contact-box:hover {
    transform: translateY(-5px);
}

.btn-wa-custom {
    transition: all 0.3s ease-in-out;
}

.btn-wa-custom:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(37, 211, 102, 0.5);
}

.custom-contact-img {
    transition: transform 0.3s ease;
}

.custom-contact-img:hover {
    transform: scale(1.05);
}

.custom-culture-image {
    transition: transform 0.3s ease;
}

.custom-culture-image:hover {
    transform: scale(1.03);
}

.process-circle {
    transition: all 0.3s ease;
}

.active-process .process-circle {
    transform: scale(1.2);
}

.process-circle.pulse {
    animation: processHighlight 1.5s infinite;
}

.scroll-btn {
    transition: all 0.3s ease;
}

.scroll-btn:hover {
    opacity: 1;
    transform: scale(1.2);
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

    // Horizontal scroll functionality for products
    setupHorizontalScroll(
        '.products-scroll-container',
        '.products-scroll-wrapper',
        '.product-card-wrapper',
        '.scroll-left',
        '.scroll-right',
        '.scroll-dots'
    );
    
    // Horizontal scroll functionality for reviews
    setupHorizontalScroll(
        '.reviews-scroll-container',
        '.reviews-scroll-wrapper',
        '.review-card-wrapper',
        '.reviews-scroll-left',
        '.reviews-scroll-right',
        '.reviews-scroll-dots'
    );
    
    function setupHorizontalScroll(containerSelector, wrapperSelector, itemSelector, leftBtnSelector, rightBtnSelector, dotsContainerSelector) {
        const container = document.querySelector(containerSelector);
        const wrapper = document.querySelector(wrapperSelector);
        const items = document.querySelectorAll(itemSelector);
        const leftBtn = document.querySelector(leftBtnSelector);
        const rightBtn = document.querySelector(rightBtnSelector);
        const dotsContainer = document.querySelector(dotsContainerSelector);
        
        if (!container || !wrapper || items.length === 0) return;
        
        // Calculate total pages
        const containerWidth = container.clientWidth;
        const itemWidth = items[0].offsetWidth;
        const gap = 20; // From CSS gap
        let itemsPerPage;
        
        // Adjust items per page based on container width
        if (containerWidth >= 992) {
            // For testimonials, show 3 per page on desktop
            itemsPerPage = containerSelector.includes('reviews') ? 3 : Math.floor(containerWidth / (itemWidth + gap));
        } else if (containerWidth >= 768) {
            // For testimonials, show 2 per page on tablets
            itemsPerPage = containerSelector.includes('reviews') ? 2 : Math.floor(containerWidth / (itemWidth + gap));
        } else {
            // For testimonials, show 1 per page on mobile
            itemsPerPage = containerSelector.includes('reviews') ? 1 : Math.floor(containerWidth / (itemWidth + gap));
        }
        
        const totalPages = Math.ceil(items.length / itemsPerPage);
        
        // Clear existing dots
        dotsContainer.innerHTML = '';
        
        // Create dots for pagination
        for (let i = 0; i < totalPages; i++) {
            const dot = document.createElement('div');
            dot.className = 'dot' + (i === 0 ? ' active' : '');
            dotsContainer.appendChild(dot);
            
            dot.addEventListener('click', () => {
                scrollToPage(i);
            });
        }
        
        // Current page index
        let currentPage = 0;
        
        // Navigation buttons
        if (leftBtn) {
            leftBtn.addEventListener('click', () => {
                if (currentPage > 0) {
                    scrollToPage(currentPage - 1);
                }
            });
        }
        
        if (rightBtn) {
            rightBtn.addEventListener('click', () => {
                if (currentPage < totalPages - 1) {
                    scrollToPage(currentPage + 1);
                }
            });
        }
        
        // Scroll to specific page
        function scrollToPage(pageIndex) {
            currentPage = pageIndex;
            const scrollAmount = pageIndex * (itemsPerPage * (itemWidth + gap));
            container.scrollTo({
                left: scrollAmount,
                behavior: 'smooth'
            });
            
            // Update dots
            const dots = dotsContainer.querySelectorAll('.dot');
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === pageIndex);
            });
            
            // Update button states
            if (leftBtn) leftBtn.style.opacity = pageIndex === 0 ? '0.3' : '0.7';
            if (rightBtn) rightBtn.style.opacity = pageIndex === totalPages - 1 ? '0.3' : '0.7';
        }
        
        // Scroll event listener for syncing UI with manual scrolling
        container.addEventListener('scroll', () => {
            const scrollPosition = container.scrollLeft;
            const pageWidth = itemsPerPage * (itemWidth + gap);
            const newPage = Math.round(scrollPosition / pageWidth);
            
            if (newPage !== currentPage && newPage >= 0 && newPage < totalPages) {
                currentPage = newPage;
                
                // Update dots
                const dots = dotsContainer.querySelectorAll('.dot');
                dots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === currentPage);
                });
                
                // Update button states
                if (leftBtn) leftBtn.style.opacity = currentPage === 0 ? '0.3' : '0.7';
                if (rightBtn) rightBtn.style.opacity = currentPage === totalPages - 1 ? '0.3' : '0.7';
            }
        });
        
        // Initial button states
        if (leftBtn) leftBtn.style.opacity = '0.3';
        if (rightBtn && totalPages <= 1) rightBtn.style.opacity = '0.3';
        
        // Touch slide functionality
        let isDown = false;
        let startX;
        let scrollLeft;
        
        container.addEventListener('mousedown', (e) => {
            isDown = true;
            container.style.cursor = 'grabbing';
            startX = e.pageX - container.offsetLeft;
            scrollLeft = container.scrollLeft;
            e.preventDefault();
        });
        
        container.addEventListener('mouseleave', () => {
            isDown = false;
            container.style.cursor = 'grab';
        });
        
        container.addEventListener('mouseup', () => {
            isDown = false;
            container.style.cursor = 'grab';
        });
        
        container.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - container.offsetLeft;
            const walk = (x - startX) * 2; // Adjust scrolling speed
            container.scrollLeft = scrollLeft - walk;
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
    
    // Intersection Observer untuk animasi saat scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.animate__fadeIn, .animate__fadeInLeft, .animate__fadeInRight, .animate__fadeInUp, .animate__zoomIn, .animate__slideInUp').forEach(element => {
        observer.observe(element);
    });
});
</script>
@endsection