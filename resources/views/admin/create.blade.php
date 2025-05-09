@extends('layouts.Admin')

@section('content')
    <!-- Header Description Section -->
    <div class="container-fluid mb-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Tambah Produk Baru</h4>
            </div>
            <div class="card-body">
                <p class="lead">Silakan isi formulir di bawah ini untuk menambahkan produk baru ke sistem.</p>
                <p>Pastikan semua informasi produk diisi dengan lengkap dan benar. Untuk gambar produk, Anda dapat mengunggah satu gambar utama dan beberapa gambar tambahan.</p>
            </div>
        </div>
    </div>

    <!-- Product Form Section -->
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Produk:</label>
                            <input type="text" name="ProductName" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Harga Produk:</label>
                            <input type="text" name="Price" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Jumlah Stok:</label>
                            <input type="number" name="Quantity" class="form-control" min="0">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Deskripsi:</label>
                            <input type="text" name="Description" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <input type="hidden" name="IsBestSeller" value="1">
                        <div class="col-md-6">
                            <label class="form-label">Kategori:</label>
                            <select name="Category" class="form-control">
                                <option value="Ulos">Ulos</option>
                                <option value="Tenun">Tenun</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar Utama:</label>
                        <input type="file" name="ImageMain" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar Lainnya:</label>
                        <input type="file" name="ImageOthers[]" class="form-control" multiple>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-save me-1"></i> Tambah Produk
                        </button>
                        <a href="{{ route('products.best') }}" class="btn btn-dark">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

<style>
    /* Enhanced Navigation Buttons Styling with Better Active Indicators */
    
    /* Navigation Container */
    .nav-buttons-container {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }
    
    /* Base Nav Button */
    .nav-btn {
        background-color: #2d3748;
        color: white;
        padding: 10px 24px;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        font-size: 15px;
        position: relative;
        transition: all 0.3s ease;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    }

    /* Hover Effect */
    .nav-btn:hover {
        background-color: #1a202c;
        transform: translateY(-2px);
    }

    /* Active Button */
    .nav-btn.active {
        background-color: #3182ce;
        color: white;
        box-shadow: 0 6px 12px rgba(49, 130, 206, 0.5);
    }

    /* Active underline */
    .nav-btn.active::after {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 50%;
        transform: translateX(-50%);
        width: 60%;
        height: 4px;
        background-color: #63b3ed;
        border-radius: 4px;
    }
    
    .nav-btn.active::after {
        width: 80%;
    }
    
    /* NEW: Active Top Indicator */
    .nav-btn.active::before {
        content: '';
        border-top: 3px solid #63b3ed;
    }
    
    /* NEW: Active State Badge */
    .nav-btn.active .active-indicator {
        position: absolute;
        top: -8px;
        right: -8px;
        background-color: #38b2ac;
        color: white;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        box-shadow: 0 0 8px rgba(56, 178, 172, 0.6);
        animation: pulse 1.5s infinite;
    }
    
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(56, 178, 172, 0.7);
        }
        70% {
            box-shadow: 0 0 0 8px rgba(56, 178, 172, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(56, 178, 172, 0);
        }
    }
    
    /* Add Button Special Style */
    .nav-btn.add-btn {
        background-color: transparent;
    }
    
    .nav-btn.add-btn::before {
        background: linear-gradient(45deg, #38a169, #48bb78);
    }
    
    .nav-btn.add-btn:hover::before {
        background: linear-gradient(45deg, #2f855a, #38a169);
    }
    
    .nav-btn.add-btn.active::before {
        background: linear-gradient(45deg, #2f855a, #38a169);
        border-top: 3px solid #9ae6b4;
    }
    
    /* Animated Hover Effect */
    .nav-btn .ripple {
        position: absolute;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.3);
        transform: scale(0);
        animation: ripple 0.6s linear;
    }
    
    @keyframes ripple {
        to {
            transform: scale(2.5);
            opacity: 0;
        }
    }
</style>
@endsection