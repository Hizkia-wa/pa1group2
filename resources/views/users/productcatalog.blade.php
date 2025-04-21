@extends('layouts.customer')

@section('content')
<div class="container py-5">
    <h2 class="text-center fs-3 fw-bold mb-4">
        Temukan koleksi Ulos berkualitas tinggi dari <br> berbagai daerah Toba
    </h2>

    {{-- Search & Filter --}}
    <form method="GET" action="{{ route('user.product.catalog') }}" class="row g-3 align-items-center mb-4">
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari ulos..." class="form-control">
                <button type="submit" class="btn btn-outline-secondary">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
        <div class="col-md-3">
            <select name="category" class="form-select">
                <option value="">Kategori</option>
                <option value="Pernikahan" {{ request('category') == 'Pernikahan' ? 'selected' : '' }}>Ulos Pernikahan</option>
                <option value="Dukacita" {{ request('category') == 'Dukacita' ? 'selected' : '' }}>Ulos Dukacita</option>
                <option value="Lahiran" {{ request('category') == 'Lahiran' ? 'selected' : '' }}>Ulos Lahiran</option>
            </select>
        </div>
        <div class="col-md-3">
            <select name="sort" class="form-select">
                <option value="">Urutkan</option>
                <option value="low" {{ request('sort') == 'low' ? 'selected' : '' }}>Harga Terendah</option>
                <option value="high" {{ request('sort') == 'high' ? 'selected' : '' }}>Harga Tertinggi</option>
                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
            </select>
        </div>
    </form>

    {{-- Produk --}}
    <div class="row">
        @forelse ($products as $product)
        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="card shadow-sm">
                @php
                    $images = json_decode($product->Images, true);
                    $imagePath = isset($images[0]) ? asset('storage/' . $images[0]) : asset('images/default.png');
                @endphp
                <img src="{{ $imagePath }}" class="card-img-top" alt="{{ $product->ProductName }}">

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-truncate">{{ $product->ProductName }}</h5>
                    <p class="card-text fw-bold">Rp. {{ number_format($product->Price, 0, ',', '.') }}</p>
                    <p class="card-text small text-muted">{{ Str::limit($product->Description, 50) }}</p>

                    <div class="mt-auto d-flex gap-2">
                        <a href="{{ route('user.product.detail', $product->id) }}" class="btn btn-primary btn-sm w-100">Beli</a>
                        <form action="{{ route('user.cart.add') }}" method="POST" class="add-to-cart-form w-100">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="size" value="200 x 50 cm">
                            <button type="submit" class="btn btn-outline-primary btn-sm w-100">
                                <i class="bi bi-cart-plus"></i> + Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center">Produk tidak ditemukan.</p>
        @endforelse
    </div>
</div>
@endsection
<style>
    /* Menetapkan ukuran tetap dan responsif pada card */
    .card {
        width: 100%;  /* Memastikan card memenuhi lebar kolom */
        height: 250px; /* Menetapkan tinggi card menjadi lebih kecil */
        display: flex;
        flex-direction: column;
        border: 1px solid #ddd; /* Border tipis untuk memisahkan card */
    }

    /* Gambar pada card */
    .card-img-top {
        height: 120px;  /* Menetapkan tinggi gambar lebih kecil */
        width: 100%; /* Gambar mengisi lebar card */
        object-fit: cover; /* Menjaga gambar tetap proporsional */
    }

    /* Menyesuaikan body card supaya tidak tumpang tindih */
    .card-body {
        flex-grow: 1;
        padding: 10px; /* Memberikan padding agar lebih rapi */
        display: flex;
        flex-direction: column;
    }

    /* Menjaga jarak antara elemen di dalam card */
    .card-title {
        font-size: 1rem;
        margin-bottom: 5px;
    }

    .card-text {
        margin-bottom: 10px;
        flex-grow: 1; /* Membuat deskripsi tidak tumpang tindih */
    }

    .card-body .d-flex.gap-2 {
        gap: 5px; /* Menambahkan jarak antar tombol */
    }

    /* Ukuran tombol yang lebih kecil */
    .btn {
        padding: 8px;
        font-size: 12px; /* Ukuran tombol lebih kecil */
    }

    /* Menyelaraskan tombol "Beli" dan "Keranjang" agar sejajar */
    .card-body .d-flex {
        justify-content: space-between; /* Menyebar tombol beli dan keranjang */
    }

    /* Navbar sticky */
    .navbar {
        position: sticky;
        top: 0;
        z-index: 1000;
        background-color: rgba(255, 255, 255, 0.9); /* Navbar transparan */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Bayangan navbar */
    }
</style>
