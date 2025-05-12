@extends('layouts.admin')

@section('title', 'Riwayat Ulasan')

@section('content')
<div class="container my-4">
    <h4 class="mb-4">Riwayat Ulasan</h4>

    @foreach ($reviews as $review)
        <div class="card mb-3 shadow-sm">
            <div class="card-body d-flex">
                {{-- Foto Profil --}}
               

                {{-- Tengah: Nama, Rating, Tanggal --}}
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

            {{-- Komentar dan Tombol --}}
            <div class="px-3 pb-3">
                <p class="mb-2">{{ $review->Comment }}</p>

                <form action="{{ route('admin.reviews.restore', $review->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-warning btn-sm">Pulihkan Kembali</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
