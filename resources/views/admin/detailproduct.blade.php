@extends('layouts.Admin') {{-- Sesuaikan dengan layout utama kamu --}}

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Gambar utama -->
        <div class="col-md-6">
        @php
            $images = json_decode($product->Images, true);
        @endphp

        @if (!empty($images))
            <img src="{{ asset('storage/' . $images[0]) }}" width="150">
        @endif


            <!-- Gambar lainnya -->
            <div class="d-flex gap-2">
                @foreach (array_slice($images, 1) as $img)
                    <img src="{{ asset('storage/' . $img) }}" class="rounded border" width="80" height="80" alt="Additional Image">
                @endforeach
            </div>
        </div>

        <!-- Detail produk -->
        <div class="col-md-6">
            <h3 class="fw-bold">{{ $product->ProductName }}</h3>
            <h5 class="text-muted mb-3">Rp {{ number_format($product->Price, 0, ',', '.') }}</h5>

            <p><strong>Kategori:</strong> {{ $product->Category }}</p>

            <p><strong>Deskripsi:</strong></p>
            <p>{{ $product->Description }}</p>

            <div class="mt-4">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit Produk</a>
            </div>
        </div>
    </div>
</div>
@endsection
