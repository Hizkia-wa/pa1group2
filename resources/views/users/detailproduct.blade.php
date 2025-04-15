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
    .product-thumbnail {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 5px;
        margin-right: 10px;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.2s;
    }
    .product-thumbnail:hover {
        border-color: #25D366;
    }
    .main-product-image {
        width: 100%;
        height: auto;
        max-height: 400px;
        object-fit: contain;
        border-radius: 10px;
    }
</style>

<div class="container mt-5 mb-5 produk-container">
    <a href="{{ url()->previous() }}" style="font-size: 20px; text-decoration: none;">←</a>
    <h2 class="text-center produk-title">Detail Produk</h2>

    <p class="mt-3 text-secondary">Beranda / Produk / <strong>{{ $product->ProductName }}</strong></p>

    <div class="row mt-4">
        <div class="col-md-6">
            <!-- Gambar Utama Produk -->
            <img id="mainProductImage" src="{{ $product->main_image_url }}" alt="{{ $product->ProductName }}" class="main-product-image" onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}'">

            <!-- Gambar Thumbnail -->
            <div class="mt-3 d-flex flex-wrap">
                @forelse ($product->all_images as $index => $imageUrl)
                    <img 
                        src="{{ $imageUrl }}" 
                        alt="{{ $product->ProductName }} - Image {{ $index + 1 }}" 
                        class="product-thumbnail"
                        onclick="changeMainImage('{{ $imageUrl }}')"
                        onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}'">
                @empty
                    <p class="text-muted">Tidak ada gambar tambahan</p>
                @endforelse
            </div>
        </div>
        <div class="col-md-6">
            <h4>{{ $product->ProductName }}</h4>
            <p>{{ $product->Description }}</p>
            <p><strong>Ukuran:</strong></p>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-dark active">200 × 50 cm</button>
                <button class="btn btn-outline-dark">200 × 50 cm</button>
                <button class="btn btn-outline-dark">200 × 50 cm</button>
            </div>
            <p class="mt-3"><strong>Jumlah:</strong> <span>{{ $product->Quantity ?? 3 }} 🧵</span></p>
            <a href="https://wa.me/6281234567890?text=Saya tertarik dengan produk {{ urlencode($product->ProductName) }}" class="btn btn-wa mt-3">
                <i class="fab fa-whatsapp"></i> Pesan Melalui WhatsApp
            </a>

            <p class="mt-3 text-muted">SKU: {{ $product->SKU ?? '-' }} | Kategori: {{ $product->Category }}</p>
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

@push('scripts')
<script>
    function changeMainImage(imageUrl) {
        document.getElementById('mainProductImage').src = imageUrl;
    }
    
    // Aktifkan tombol ukuran yang dipilih
    document.querySelectorAll('.btn-outline-dark').forEach(button => {
        button.addEventListener('click', function() {
            // Hapus class active dari semua tombol
            document.querySelectorAll('.btn-outline-dark').forEach(btn => {
                btn.classList.remove('active');
            });
            // Tambahkan class active ke tombol yang diklik
            this.classList.add('active');
        });
    });
</script>
@endpush
@endsection