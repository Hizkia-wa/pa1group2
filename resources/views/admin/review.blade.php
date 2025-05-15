@extends('layouts.admin')

@section('title', 'Ulasan')

@section('content')
<div class="container my-4">
    <div class="row g-4">
       
        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h5 class="mb-2">Rating</h5>
                <h2 class="fw-bold mb-3">
                    {{ number_format($averageRating, 1, ',', '.') }}
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= floor($averageRating))
                            <i class="bi bi-star-fill text-warning"></i>
                        @elseif ($i - $averageRating < 1)
                            <i class="bi bi-star-half text-warning"></i>
                        @else
                            <i class="bi bi-star text-warning"></i>
                        @endif
                    @endfor
                </h2>

                @foreach (range(5, 1) as $rate)
                    @php
                        $count = $ratings->get($rate, 0);
                        $percentage = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
                    @endphp
                    <div class="d-flex align-items-center mb-2">
                        <span class="me-2">{{ $rate }} <i class="bi bi-star-fill text-warning"></i></span>
                        <div class="progress flex-grow-1 me-2" style="height: 10px;">
                            <div class="progress-bar bg-warning" style="width: {{ $percentage }}%"></div>
                        </div>
                        <span>{{ $count }}</span>
                    </div>
                @endforeach

                <hr>
                <h6 class="mb-0">Jumlah Ulasan</h6>
                <h3 class="fw-bold">{{ number_format($totalReviews, 0, ',', '.') }}</h3>
            </div>
        </div>

       
        <div class="col-md-8">
            @foreach ($reviews as $review)
                <div class="card mb-3 shadow-sm">
                    <div class="card-body d-flex">
                       
                     
                        <div class="flex-grow-1 d-flex justify-content-between">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="fw-bold mb-1">{{ $review->ReviewerName }}</h6>
                                <div class="mb-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="bi {{ $i <= $review->Rating ? 'bi-star-fill' : 'bi-star' }} text-warning"></i>
                                    @endfor
                                </div>
                            </div>
                            <div class="text-end">
                                <small class="text-muted">Ditulis {{ $review->created_at->format('d M Y') }}</small>
                            </div>
                        </div>
                    </div>

                    {{-- Komentar dan tombol --}}
                    <div class="px-3 pb-3">
                        <p class="mb-2">{{ $review->Comment }}</p>
                        <form action="{{ route('admin.reviews.hide', $review->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-warning btn-sm">Sembunyikan</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection
