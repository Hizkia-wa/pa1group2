@extends('layouts.app') {{-- Atau layout yang kamu gunakan untuk user --}}

@section('content')
<style>
    .btn-wa {
        background-color: #25D366;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 30px;
    }
    .btn-wa:hover {
        background-color: #1DA851;
    }
    .produk-container {
        padding: 40px;
        background-color: white;
        border-radius: 20px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .produk-title {
        font-size: 28px;
        font-weight: bold;
    }
</style>

<div class="container mt-5 mb-5 produk-container">
    <a href="{{ url()->previous() }}" style="font-size: 20px;">←</a>
    <h2 class="text-center produk-title">Detail Produk</h2>

    <p class="mt-3 text-secondary">Beranda / Produk / <strong>{{ $product->ProductName }}</strong></p>

    <div class="row mt-4">
        <div class="col-md-6">
            @php $images = json_decode($product->Images, true); @endphp
            @if (!empty($images))
               <img src="{{ asset('images/' . $product->image) }}" alt="Produk">


                <div class="mt-3 d-flex">
                    @foreach ($images as $img)
                       <img src="{{ asset('storage/' . $product->image) }}" alt="Produk">

                    @endforeach
                </div>
            @endif
        </div>
        <div class="col-md-6">
            <h4>{{ $product->ProductName }}</h4>
            <p>{{ $product->Description }}</p>
            <p><strong>Ukuran:</strong></p>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-dark">200 × 50 cm</button>
                <button class="btn btn-outline-dark">200 × 50 cm</button>
                <button class="btn btn-outline-dark">200 × 50 cm</button>
            </div>
            <p class="mt-3"><strong>Jumlah:</strong> <span>3 🧵</span></p>
            <a href="https://wa.me/6281234567890" class="btn btn-wa mt-3">Pesan Melalui WhatsApp</a>

            <p class="mt-3 text-muted">SKU: {{ $product->SKU }} | Kategori: {{ $product->Category }}</p>
        </div>
    </div>

    <div class="mt-5">
        <h5>Keunggulan Produk</h5>
        <ul>
            <li>Dibuat dengan teknik tenun tradisional</li>
            <li>Menggunakan benang berkualitas tinggi</li>
            <li>Motif asli khas Batak</li>
            <li>Pewarnaan dengan teknik alami</li>
        </ul>
    </div>
</div>
@endsection
