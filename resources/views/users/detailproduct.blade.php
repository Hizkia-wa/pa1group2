@extends('layouts.User')

@section('content')
<style>
    .container {
        max-width: 1200px;
        margin: 40px auto;
        display: flex;
        gap: 40px;
        flex-wrap: wrap;
    }

    .product-detail {
        flex: 1;
        background-color: #e0f7fa;
        padding: 20px;
        border-radius: 10px;
    }

    .product-detail img.main-image {
        width: 100%;
        max-height: 300px;
        object-fit: cover;
        border-radius: 8px;
    }

    .product-detail .thumbnail-group {
        display: flex;
        gap: 10px;
        margin-top: 10px;
        flex-wrap: wrap;
    }

    .product-detail .thumbnail-group img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    .order-form {
        flex: 1;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid #ccc;
    }

    .order-form h5 {
        margin-bottom: 20px;
        color: #007bff;
    }

    .order-form .form-group {
        margin-bottom: 15px;
    }

    .order-form label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .order-form input[type="text"],
    .order-form input[type="email"],
    .order-form input[type="number"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .order-form .size-options {
        display: flex;
        gap: 10px;
    }

    .order-form .size-options label {
        padding: 8px 12px;
        border: 1px solid #007bff;
        border-radius: 5px;
        cursor: pointer;
    }

    .order-form .size-options input[type="radio"] {
        display: none;
    }

    .order-form .size-options input[type="radio"]:checked + label {
        background-color: #007bff;
        color: white;
    }

    .btn-submit {
        background-color: #25d366;
        color: white;
        border: none;
        padding: 12px;
        font-weight: bold;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
    }

    .product-meta {
        margin-top: 15px;
        font-size: 0.9rem;
        color: #666;
    }
</style>

<div class="container">
    <!-- Detail Produk -->
    <div class="product-detail">
        <img src="{{ $product->all_images[0] ?? asset('images/no-image.png') }}" class="main-image" alt="Foto Produk">
        <div class="thumbnail-group">
            @foreach ($product->all_images as $image)
                <img src="{{ $image }}" alt="Gambar Tambahan">
            @endforeach
        </div>

        <h3 class="mt-3">{{ $product->ProductName }}</h3>
        <p style="color: red; font-size: 1.2rem;">Rp {{ number_format($product->Price, 0, ',', '.') }}</p>

        <h4>Deskripsi Produk</h4>
        <p>{{ $product->Description }}</p>

        <h5>Keunggulan Produk</h5>
        <ul>
            <li>Dibuat dengan teknik tenun tradisional</li>
            <li>Bahan berkualitas tinggi</li>
            <li>Motif khas yang elegan</li>
        </ul>
    </div>

    <!-- Form Pemesanan -->
    <div class="order-form">
        <form action="{{ route('user.product.order') }}" method="POST">
            @csrf
            <input type="hidden" name="ProductId" value="{{ $product->id }}">

            <h5>Form Pemesanan</h5>

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Telepon</label>
                <input type="text" name="phone" required>
            </div>

            <div class="form-group">
                <label>Kabupaten/Kota</label>
                <input type="text" name="city" required>
            </div>

            <div class="form-group">
                <label>Kecamatan</label>
                <input type="text" name="district" required>
            </div>

            <div class="form-group">
                <label>Jalan</label>
                <input type="text" name="address" required>
            </div>

            <div class="form-group">
                <label>Kode Pos</label>
                <input type="text" name="postal_code" required>
            </div>

            <div class="form-group">
                <label>Ukuran</label>
                <div class="size-options">
                    <input type="radio" id="size1" name="size" value="200 x 50 cm" checked>
                    <label for="size1">200 x 50 cm</label>

                    <input type="radio" id="size2" name="size" value="300 x 50 cm">
                    <label for="size2">300 x 50 cm</label>

                    <input type="radio" id="size3" name="size" value="200 x 60 cm">
                    <label for="size3">200 x 60 cm</label>
                </div>
            </div>

            <div class="form-group">
                <label>Jumlah</label>
                <input type="number" name="Quantity" value="1" min="1" required>
            </div>

            <button type="submit" class="btn-submit"><i class="bi bi-whatsapp me-2"></i>Pesan Melalui WhatsApp</button>

            <div class="product-meta">
                <div>SKU: REUH-4234-UU</div>
                <div>Kategori: {{ $product->Category }}</div>
            </div>
        </form>
    </div>
</div>
@endsection
