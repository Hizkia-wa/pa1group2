@extends('layouts.admin')

@section('content')
<div class="container">
    <a href="{{ route('admin.products') }}" class="btn btn-light mb-3">← Kembali</a>

    <h2 class="text-center mb-4">Detail Produk</h2>

    <div class="row">
        <div class="col-md-5">
            {{-- Gambar utama --}}
            @if(!empty($product->Images) && is_array(json_decode($product->Images, true)))
                @php
                    $decodedImages = json_decode($product->Images, true);
                    $mainImage = $decodedImages[0] ?? null;
                    $carouselImages = array_slice($decodedImages, 1);
                @endphp

                @if($mainImage)
                    <img src="{{ asset('storage/' . $mainImage) }}" class="img-fluid rounded shadow-sm">
                @else
                    <div class="bg-secondary text-white text-center py-5 rounded">Gambar Utama Tidak Tersedia</div>
                @endif

                {{-- Carousel --}}
                <div class="mt-3 d-flex flex-wrap">
                    @forelse($carouselImages as $carousel)
                        <img src="{{ asset('storage/' . $carousel) }}" class="img-thumbnail me-2 mb-2" width="100">
                    @empty
                        <span class="text-muted">Tidak ada gambar tambahan</span>
                    @endforelse
                </div>
            @else
                <div class="bg-secondary text-white text-center py-5 rounded">Tidak ada gambar tersedia</div>
            @endif
        </div>

        <div class="col-md-7">
            <h3>{{ $product->ProductName }}</h3>
            <span class="badge bg-primary">{{ $product->Category }}</span>

            <p class="mt-3">{{ $product->Description }}</p>

            <h5 class="mt-4">Ukuran:</h5>
            <div class="btn-group" role="group">
                <button class="btn btn-outline-dark">200 x 50 cm</button>
                <button class="btn btn-outline-dark">200 x 60 cm</button>
                <button class="btn btn-outline-dark">200 x 70 cm</button>
            </div>

            <h5 class="mt-4">Jumlah:</h5>
            <input type="number" class="form-control w-25" min="1" value="1">

            <h4 class="mt-3 text-success">Rp {{ number_format($product->Price, 0, ',', '.') }}</h4>

            <a href="https://wa.me/?text={{ urlencode('Saya tertarik dengan produk ' . $product->ProductName) }}" target="_blank" class="btn btn-success mt-3">
                Pesan Melalui WhatsApp
            </a>

            <h6 class="mt-4 text-muted">SKU: 4544-2134-034 | Kategori: {{ $product->Category }}</h6>
        </div>
    </div>

    <div class="mt-5">
        <h4>Keunggulan Produk</h4>
        <ul>
            <li>Dibuat dengan teknik tenun tradisional</li>
            <li>Motif asli Batak</li>
            <li>Warna tahan lama</li>
            <li>Premium dengan kualitas tinggi</li>
        </ul>
    </div>
</div>
@endsection
