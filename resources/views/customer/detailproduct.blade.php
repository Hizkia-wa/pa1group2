@extends('layouts.customer')

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
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .product-detail img.main-image {
        width: 100%;
        max-height: 300px;
        object-fit: cover;
        border-radius: 8px;
    }

    .order-form {
        flex: 1;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid #ccc;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
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
        margin-top: 20px;
    }
</style>

<div class="container">
    <!-- Detail Produk -->
    <div class="product-detail">
        <img src="{{ $product->all_images[0] ?? asset('images/no-image.png') }}" class="main-image" alt="Foto Produk">
        <h3 class="mt-3">{{ $product->ProductName }}</h3>
        <p style="color: red; font-size: 1.2rem;">Rp {{ number_format($product->Price, 0, ',', '.') }}</p>
        <p><strong>Stok:</strong> <span id="product-stock">{{ $product->Quantity }}</span></p>
        <h4>Deskripsi Produk</h4>
        <p>{{ $product->Description }}</p>
    </div>

    <!-- Form Pemesanan -->
    <div class="order-form">
        <form id="orderForm" action="{{ route('customer.product.order') }}" method="POST">
            @csrf
            <input type="hidden" name="ProductId" value="{{ $product->id }}">

            <h5>Form Pemesanan</h5>

            <div class="form-group">
                <label>Nama</label>
                <!-- Isi kolom dengan nama yang sudah terdaftar, tetapi tetap bisa diubah -->
                <input type="text" name="name" value="{{ Auth::user()->CustomerName }}" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <!-- Isi kolom dengan email yang sudah terdaftar, tetapi tetap bisa diubah -->
                <input type="email" name="email" value="{{ Auth::user()->Email }}" required>
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
                <label>Jumlah</label>
                <input type="number" name="Quantity" value="1" min="1" required>
            </div>

            <button type="submit" class="btn-submit">
                <i class="bi bi-whatsapp me-2"></i>Pesan Melalui WhatsApp
            </button>
        </form>
    </div>
</div>

@endsection
