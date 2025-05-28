@extends('layouts.Admin')

@section('content')
<!-- Header Section -->
<div class="container-fluid mb-4">
    <div class="card shadow border-0 rounded-4">
        <div class="card-header bg-maroon text-white rounded-top-4">
            <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i> Tambah Produk Baru</h4>
        </div>
        <div class="card-body">
            <p class="lead text-maroon">Silakan isi formulir berikut untuk menambahkan produk baru.</p>
            <p class="text-secondary">Lengkapi informasi produk secara detail agar tampil optimal di halaman pelanggan.</p>
        </div>
    </div>
</div>

<!-- Form Section -->
<div class="container-fluid">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">
            <form action="{{ route('products.storeRegular') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-maroon">Nama Produk:</label>
                        <input type="text" name="ProductName" class="form-control shadow-sm" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-maroon">Harga Produk:</label>
                        <input type="text" name="Price" class="form-control shadow-sm" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-maroon">Jumlah Stok:</label>
                        <input type="number" name="Quantity" class="form-control shadow-sm" min="0" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-maroon">Kategori:</label>
                        <select name="Category" class="form-control shadow-sm" required>
                            <option disabled selected>Pilih Kategori</option>
                            <option value="Ulos">Ulos</option>
                            <option value="Tenun">Tenun</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold text-maroon">Deskripsi:</label>
                    <textarea name="Description" class="form-control shadow-sm" rows="3"></textarea>
                </div>

                <input type="hidden" name="IsBestSeller" value="0">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-maroon">Gambar Utama:</label>
                        <input type="file" name="ImageMain" class="form-control shadow-sm" accept="image/*" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-maroon">Gambar Lainnya:</label>
                        <input type="file" name="ImageOthers[]" class="form-control shadow-sm" accept="image/*" multiple>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('products.best') }}" class="btn btn-secondary shadow-sm">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-maroon shadow-sm">
                        <i class="fas fa-save me-1"></i> Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Custom Style -->
<style>
    .bg-maroon {
        background-color: #800000 !important;
    }

    .text-maroon {
        color: #800000 !important;
    }

    .btn-maroon {
        background-color: #800000;
        color: #fff;
        font-weight: 600;
        transition: 0.3s ease-in-out;
    }

    .btn-maroon:hover {
        background-color: #a52a2a;
        transform: scale(1.03);
    }

    .form-control:focus, select:focus, textarea:focus {
        border-color: #800000;
        box-shadow: 0 0 0 0.2rem rgba(128, 0, 0, 0.25);
    }

    .card-header h4 {
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .btn-secondary:hover {
        background-color: #6c757d;
        transform: scale(1.02);
    }
</style>
@endsection
