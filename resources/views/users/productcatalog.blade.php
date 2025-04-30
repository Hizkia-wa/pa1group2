{{-- LANGKAH 3: Perbarui tampilan productcatalog.blade.php --}}
@extends('layouts.user')

@section('content')
<div class="container py-5">
    <h2 class="text-center fs-3 fw-bold mb-4">
        Temukan koleksi Ulos berkualitas tinggi dari <br> berbagai daerah Toba
    </h2>

    {{-- Form Pencarian & Filter --}}
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
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                        {{ $category }}
                    </option>
                @endforeach
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

    {{-- Hasil Pencarian --}}
    @if(request('search') || request('category') || request('sort'))
    <div class="alert alert-info mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                Menampilkan hasil {{ $products->count() }} dari {{ $products->total() }} produk
                @if(request('search')) untuk pencarian "{{ request('search') }}" @endif
                @if(request('category')) dalam kategori "{{ request('category') }}" @endif
            </div>
            <a href="{{ route('user.product.catalog') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-x-circle"></i> Reset Filter
            </a>
        </div>
    </div>
    @endif

    {{-- Produk --}}
    <div class="row">
        @forelse ($products as $product)
        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="product-card">
                @php
                    $images = json_decode($product->Images, true);
                    $imagePath = isset($images[0]) ? asset('storage/' . $images[0]) : asset('images/default.png');
                @endphp
                <img src="{{ $imagePath }}" class="product-img" alt="{{ $product->ProductName }}">

                <div class="product-info">
                    <h5 class="product-title">{{ $product->ProductName }}</h5>
                    <p class="product-desc">{{ Str::limit($product->Description, 40) }}</p>
                    <p class="product-price">Rp {{ number_format($product->Price, 0, ',', '.') }}</p>

                    <div class="product-actions">
                        <a href="{{ route('user.product.detail', $product->id) }}" class="btn-buy">Beli</a>
                        <form action="{{ route('user.cart.add') }}" method="POST" class="form-cart">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="size" value="200 x 50 cm">
                            <button type="submit" class="btn-cart">
                                <i class="bi bi-cart-plus"></i> Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-4">
            <div class="alert alert-secondary">
                <i class="bi bi-search-heart fs-3 d-block mb-3"></i>
                <h5>Produk tidak ditemukan</h5>
                <p class="mb-0">Maaf, produk yang Anda cari tidak tersedia saat ini.</p>
            </div>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $products->appends(request()->query())->links() }}
    </div>
</div>
@endsection

{{-- CSS untuk Styling --}}
<style>
    /* Modern Card Design */
    .product-card {
        width: 100%;
        height: 100%;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        background: white;
        transition: transform 0.2s;
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.1);
    }

    .product-img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .product-info {
        padding: 12px 15px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .product-title {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 4px;
        color: #333;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
    }

    .product-desc {
        font-size: 12px;
        color: #666;
        margin-bottom: 8px;
        line-height: 1.3;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .product-price {
        font-size: 16px;
        font-weight: 700;
        color: #ff4d4d;
        margin-bottom: 16px;
        margin-top: auto;
    }

    .product-actions {
        display: flex;
        gap: 8px;
        margin-top: auto;
    }

    .btn-buy, .btn-cart {
        width: 100%;
        padding: 10px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        text-align: center;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .btn-buy {
        background-color: #2563eb; 
        color: white;
        text-decoration: none;
    }

    .btn-buy:hover {
        background-color: #1d4ed8;
    }

    .btn-cart {
        background-color: white;
        color: #2563eb;
        border: 1px solid #2563eb;
        gap: 4px;
    }

    .btn-cart:hover {
        background-color: #f0f7ff;
    }
    
    .form-cart {
        width: 100%;
        display: flex;
    }

    /* Tambahan untuk Alert Hasil Pencarian */
    .alert-info {
        background-color: #f0f7ff;
        border-color: #d1e6ff;
        color: #0059b3;
    }
</style>