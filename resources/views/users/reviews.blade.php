@extends('layouts.User')

@section('title', 'Ulasan')

@section('content')
<div class="container my-4">
    <div class="row g-4">

        {{-- Rating Summary & Form --}}
        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h5 class="mb-2">Rating</h5>
                <h2 class="fw-bold">
                    {{ number_format($averageRating, 1, ',', '.') }}
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= floor($averageRating))
                            <i class="bi bi-star-fill text-warning"></i>
                        @elseif ($i - $averageRating < 1)
                            <i class="bi bi-star-half text-warning"></i>
                        @else
                            <i class="bi bi-star-fill text-secondary"></i>
                        @endif
                    @endfor
                </h2>

                {{-- Rating Progress Bars --}}
                @foreach (range(5, 1) as $rate)
                    @php
                        $count = $ratings->get($rate, 0);
                        $percentage = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
                    @endphp
                    <div class="d-flex align-items-center">
                        <span class="me-2">{{ $rate }} <i class="bi bi-star-fill text-warning"></i></span>
                        <div class="progress flex-grow-1 me-2" style="height: 10px;">
                            <div class="progress-bar bg-warning" style="width: {{ $percentage }}%"></div>
                        </div>
                        <span>{{ $count }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Form Tambah Ulasan --}}
        <div class="col-md-8">
            <div class="card shadow-sm p-4">
                <h5 class="mb-3">Kirim Ulasan Anda</h5>
                <form action="{{ route('user.reviews.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Tambahkan Rating</label>
                        <div id="starRating" class="d-flex">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star-fill star-rating text-secondary" data-value="{{ $i }}"></i>
                            @endfor
                        </div>
                        <input type="hidden" name="Rating" id="ratingInput">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="ReviewerName" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pesan</label>
                        <textarea name="Comment" class="form-control" rows="4"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Daftar Ulasan --}}
    <div class="mt-5">
        @foreach ($reviews as $review)
            <div class="card mb-3 shadow-sm">
                <div class="card-body d-flex">
                    {{-- Foto Profil --}}
                    <div class="me-3 d-flex align-items-start">
                        <img src="{{ asset('images/default-profile.png') }}" alt="Foto Profil" class="rounded-circle" width="50" height="50">
                    </div>

                    {{-- Konten Utama --}}
                    <div class="flex-grow-1 d-flex justify-content-between">
                        {{-- Tengah: Nama dan Rating --}}
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="fw-bold mb-1">{{ $review->ReviewerName }}</h6>
                            <div class="mb-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star-fill {{ $i <= $review->Rating ? 'text-warning' : 'text-secondary' }}"></i>
                                @endfor
                            </div>
                        </div>

                        {{-- Kanan: Tanggal --}}
                        <div class="text-end">
                            <small class="text-muted">Ditulis {{ $review->created_at->format('d M Y') }}</small>
                        </div>
                    </div>
                </div>

                {{-- Komentar --}}
                <div class="px-3 pb-3">
                    <p class="mb-0">{{ $review->Comment }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
<style>
    .star-rating {
        font-size: 1.5rem;
        cursor: pointer;
        margin-right: 0.25rem;
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const stars = document.querySelectorAll('.star-rating');
        const ratingInput = document.getElementById('ratingInput');
        let currentRating = 0;

        // Fungsi untuk mengatur tampilan bintang sesuai rating
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

        // Event untuk klik bintang
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
            
            // Event untuk hover bintang
            star.addEventListener('mouseenter', function() {
                const value = parseInt(this.getAttribute('data-value'));
                // Tampilkan preview rating saat hover
                updateStars(value);
            });
        });
        
        // Kembalikan tampilan ke rating yang dipilih saat mouse keluar
        document.getElementById('starRating').addEventListener('mouseleave', function() {
            updateStars(currentRating);
        });
    });
</script>
@endsection