@extends('layouts.Admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg rounded-4 border-0">
        <div class="card-header text-white rounded-top-4" style="background-color: #800000;">
            <h4 class="mb-0"><i class="fas fa-plus-circle"></i> Tambah Produk Baru</h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="fw-semibold">Nama Produk:</label>
                        <input type="text" name="ProductName" class="form-control shadow-sm" required>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-semibold">Harga Produk:</label>
                        <input type="text" name="Price" class="form-control shadow-sm" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="fw-semibold">Jumlah Stok:</label>
                        <input type="number" name="Quantity" class="form-control shadow-sm" min="0" required>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-semibold">Kategori:</label>
                        <select name="Category" class="form-control shadow-sm" required>
                            <option disabled selected>Pilih Kategori</option>
                            <option value="Ulos">Ulos</option>
                            <option value="Tenun">Tenun</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold">Deskripsi:</label>
                    <textarea name="Description" class="form-control shadow-sm" rows="3"></textarea>
                </div>

                <input type="hidden" name="IsBestSeller" value="1">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="fw-semibold">Gambar Utama:</label>
                        <input type="file" name="ImageMain" class="form-control shadow-sm" accept="image/*" required>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-semibold">Gambar Lainnya:</label>
                        <input type="file" name="ImageOthers[]" class="form-control shadow-sm" accept="image/*" multiple>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('products.best') }}" class="btn btn-secondary shadow-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-maroon shadow-sm">
                        <i class="fas fa-save"></i> Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Tambahkan Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

{{-- Custom Style --}}
<style>
    :root {
        --maroon: #800000;
        --maroon-hover: #660000;
        --input-focus-shadow: rgba(128, 0, 0, 0.25);
    }

    input[type="text"]:focus,
    input[type="number"]:focus,
    select:focus,
    textarea:focus {
        border-color: var(--maroon);
        box-shadow: 0 0 0 0.2rem var(--input-focus-shadow);
    }

    .btn-maroon {
        background-color: var(--maroon);
        color: white;
        border: none;
    }

    .btn-maroon:hover {
        background-color: var(--maroon-hover);
        transform: scale(1.03);
        transition: all 0.2s ease-in-out;
    }

    .btn-secondary:hover {
        background-color: #5a5a5a;
        transform: scale(1.02);
        transition: all 0.2s ease-in-out;
    }

    .card-header h4 {
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    label {
        color: #333;
    }
</style>
@endsection
