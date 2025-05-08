@extends('layouts.User')

@section('title', 'Ulasan')

@section('content')
<div class="review-header mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="review-title">Ulasan Pelanggan</h1>
                <div class="review-decoration">
                    <span class="line-left"></span>
                    <i class="bi bi-chat-quote"></i>
                    <span class="line-right"></span>
                </div>
                <p class="review-tagline">Bagikan pengalaman Anda dengan ulos kami! Tulis ulasan untuk membantu kami meningkatkan kualitas dan menginspirasi pembeli lain.</p>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row g-4">
        <!-- Rating Summary -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-lg rating-summary-card h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-4">Rating Keseluruhan</h5>
                    <div class="text-center mb-4">
                        <div class="display-4 fw-bold text-warning">{{ number_format($averageRating, 1, ',', '.') }}</div>
                        <div class="rating-stars fs-4 mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= floor($averageRating))
                                    <i class="bi bi-star-fill text-warning"></i>
                                @elseif ($i - $averageRating < 1)
                                    <i class="bi bi-star-half text-warning"></i>
                                @else
                                    <i class="bi bi-star-fill text-secondary"></i>
                                @endif
                            @endfor
                        </div>
                        <p class="text-muted">Berdasarkan {{ $totalReviews }} ulasan</p>
                    </div>

                    <div class="rating-bars">
                        @foreach (range(5, 1) as $rate)
                            @php
                                $count = $ratings->get($rate, 0);
                                $percentage = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
                            @endphp
                            <div class="d-flex align-items-center mb-2">
                                <span class="me-2 fw-medium">{{ $rate }}</span>
                                <i class="bi bi-star-fill text-warning me-2"></i>
                                <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                    <div class="progress-bar bg-warning" style="width: {{ $percentage }}%"></div>
                                </div>
                                <span class="text-muted small">{{ $count }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-8">
            <!-- Review Form -->
            <div id="review-form" class="card shadow-lg mb-4">
                <div class="card-header bg-gradient-primary text-white" style="background: linear-gradient(135deg, #ff9800, #ffab40);">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i>Tulis Ulasan Anda</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.reviews.store') }}" method="POST" class="review-form">
                        @csrf
                        
                        <div class="mb-4 text-center">
                            <label class="form-label d-block mb-3 fw-bold">Berikan Penilaian</label>
                            <div id="starRating" class="star-rating-container">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star-fill star-rating text-secondary" data-value="{{ $i }}"></i>
                                @endfor
                            </div>
                            <input type="hidden" name="Rating" id="ratingInput">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" name="ReviewerName" class="form-control" id="reviewerName" placeholder="Nama Lengkap" required>
                                    <label for="reviewerName">Nama Lengkap</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="reviewerEmail" placeholder="Email (Opsional)">
                                    <label for="reviewerEmail">Email (Opsional)</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-floating">
                                <textarea name="Comment" class="form-control" id="reviewComment" style="height: 150px" placeholder="Bagikan pengalaman Anda dengan produk ini"></textarea>
                                <label for="reviewComment">Bagikan pengalaman Anda dengan produk ini</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="agreeTerms">
                                <label class="form-check-label" for="agreeTerms">
                                    Saya menyetujui ulasan ini akan dipublikasikan di website ini
                                </label>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary rounded-pill px-5 py-2">
                                <i class="bi bi-send-fill me-2"></i>Kirim Ulasan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
         
           
                </div>
                <div class="card-body p-0">
                    @if(count($reviews) > 0)
                        <div class="review-list">
                            @foreach ($reviews->take(4) as $review)
                                <div class="review-item p-4 {{ !$loop->last ? 'border-bottom' : '' }}">
                                    <div class="d-flex">
                                        <!-- Profile Photo -->
                                        <div class="me-3">
                                            <div class="avatar-circle">
                                                <span class="avatar-initials">{{ substr($review->ReviewerName, 0, 1) }}</span>
                                            </div>
                                        </div>
                                        
                                        <!-- Review Content -->
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <div>
                                                    <h6 class="fw-bold mb-1">{{ $review->ReviewerName }}</h6>
                                                    <div class="review-rating mb-2">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i class="bi bi-star-fill {{ $i <= $review->Rating ? 'text-warning' : 'text-secondary' }}"></i>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <div class="text-muted small bg-light py-1 px-2 rounded-pill">
                                                    <i class="bi bi-calendar3 me-1"></i>{{ $review->created_at->format('d M Y') }}
                                                </div>
                                            </div>
                                            
                                            <div class="review-text">
                                                <p class="mb-0">{{ $review->Comment }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                       
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-chat-square-text display-4 text-muted"></i>
                            <p class="mt-3">Belum ada ulasan untuk produk ini.</p>
                            <p>Jadilah yang pertama memberikan ulasan!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<style>
  
    .review-header {
        background: url("{{ asset('img/ulos/backgroundulasan.jpg') }}") center/cover no-repeat fixed;
        padding: 80px 0; 
        margin-top: 25px;
        position: relative;
        border-bottom: 1px solid rgba(255, 152, 0, 0.3);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .review-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.85);
        z-index: 1;
    }

    .review-header .container {
        position: relative;
        z-index: 2;
    }

    .review-title {
        color: #ff9800;
        font-weight: 700;
        font-size: 2.5rem;
        margin-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .review-tagline {
        color: black;
        font-size: 1.1rem;
        max-width: 800px;
        margin: 0 auto;
        line-height: 1.7;
    }
    
    .review-decoration {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 20px 0;
    }
    
    .line-left, .line-right {
        height: 2px;
        width: 100px;
        background: linear-gradient(90deg, transparent, #ff9800);
        display: inline-block;
    }
    
    .line-right {
        background: linear-gradient(90deg, #ff9800, transparent);
    }
    
    .review-decoration i {
        font-size: 1.5rem;
        color: #ff9800;
        margin: 0 15px;
    }
  
    .card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
    }
    
    .card-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1.25rem 1.5rem;
    }
    
    .rating-summary-card {
        background: linear-gradient(135deg, #ffffff, #f8f9fa);
        border-left: 4px solid #ff9800;
    }
    
    /* Review List Styling */
    .review-item {
        transition: background-color 0.2s ease;
    }
    
    .review-item:hover {
        background-color: #f8f9fa;
    }
    
    .review-item:last-child {
        border-bottom: none !important;
    }
    
    .avatar-circle {
        width: 50px;
        height: 50px;
        background-color: #ff9800;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 1.5rem;
    }
    
    .review-actions button {
        border-radius: 20px;
        font-size: 0.8rem;
        padding: 0.25rem 0.75rem;
    }
    
    /* Star Rating Styling */
    .star-rating-container {
        display: inline-flex;
        justify-content: center;
        background-color: #f8f9fa;
        padding: 10px 20px;
        border-radius: 50px;
        box-shadow: inset 0 2px 5px rgba(0,0,0,0.05);
        margin-bottom: 1.5rem;
    }
    
    .star-rating {
        font-size: 2.2rem;
        cursor: pointer;
        margin: 0 0.4rem;
        transition: all 0.3s ease;
        filter: drop-shadow(0 2px 3px rgba(0,0,0,0.1));
    }
    
    .star-rating:hover {
        transform: scale(1.3) rotate(5deg);
    }
    
    .star-rating.text-warning {
        filter: drop-shadow(0 2px 5px rgba(255, 193, 7, 0.5));
    }
    
    /* Button Styling */
    .btn-primary {
        background-color: #ff9800;
        border-color: #ff9800;
        padding: 8px 20px;
        border-radius: 30px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover, .btn-primary:focus {
        background-color: #e68a00;
        border-color: #e68a00;
        box-shadow: 0 5px 15px rgba(255, 152, 0, 0.4);
    }
    
    .btn-outline-primary {
        color: #ff9800;
        border-color: #ff9800;
    }
    
    .btn-outline-primary:hover {
        background-color: #ff9800;
        border-color: #ff9800;
    }
    
    /* Form Styling */
    .form-floating>.form-control {
        padding: 1.5rem 1rem;
    }
    
    .form-floating>.form-control:focus {
        border-color: #ff9800;
        box-shadow: 0 0 0 0.25rem rgba(255, 152, 0, 0.25);
    }
    
    .form-check-input:checked {
        background-color: #ff9800;
        border-color: #ff9800;
    }
    
    /* Animation */
    .review-title, .review-decoration, .review-tagline {
        animation: fadeInUp 0.8s ease-out forwards;
    }
    
    .review-decoration {
        animation-delay: 0.2s;
    }
    
    .review-tagline {
        animation-delay: 0.4s;
    }
    
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
    
  
    .pagination .page-link {
        color: #ff9800;
    }
    
    .pagination .page-item.active .page-link {
        background-color: #ff9800;
        border-color: #ff9800;
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Star rating functionality
        const stars = document.querySelectorAll('.star-rating');
        const ratingInput = document.getElementById('ratingInput');
        let currentRating = 0;

        function updateStars(rating) {
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.remove('text-secondary');
                    star.classList.add('text-warning');
                } else {
                    star.classList.remove('text-warning');
                    star.classList.add('text-secondary');
                }
            });
        }

        stars.forEach((star, index) => {
            star.addEventListener('click', function() {
                const value = parseInt(this.getAttribute('data-value'));
                
                // Toggle rating - jika sudah dipilih, batalkan pilihan
                if (currentRating === value) {
                    currentRating = 0;
                    ratingInput.value = '';
                } else {
                    currentRating = value;
                    ratingInput.value = value;
                }
                
                updateStars(currentRating);
            });
            
            star.addEventListener('mouseenter', function() {
                const value = parseInt(this.getAttribute('data-value'));
                // Tampilkan preview rating saat hover
                updateStars(value);
            });
        });
        
        document.getElementById('starRating').addEventListener('mouseleave', function() {
            updateStars(currentRating);
        });
        
        // Smooth scroll to review form
        document.querySelectorAll('a[href="#review-form"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    });
</script>
@endsection
@endsection