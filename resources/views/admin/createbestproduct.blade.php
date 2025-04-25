@extends('layouts.Admin')

@section('content')
    <div class="nav-buttons-container">
        <a href="{{ route('products.index') }}" class="nav-btn {{ request()->routeIs('products.index') ? 'active' : '' }}">
            <i class="fas fa-boxes"></i> Produk Kita
            @if(request()->routeIs('products.index'))
                <span class="active-indicator"></span>
            @endif
        </a>
        <a href="{{ route('products.best') }}" class="nav-btn {{ request()->routeIs('products.best') ? 'active' : '' }}">
            <i class="fas fa-fire"></i> Produk Laris
            @if(request()->routeIs('products.best'))
                <span class="active-indicator"></span>
            @endif
        </a>
        <a href="{{ route('products.create') }}" class="nav-btn add-btn {{ request()->routeIs('products.create') ? 'active' : '' }}">
            <i class="fas fa-plus"></i> Tambah Produk
            @if(request()->routeIs('products.best.create'))
                <span class="active-indicator"></span>
            @endif
        </a>
    </div>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-2">
            <div class="col-md-6">
                <label>Nama Produk:</label>
                <input type="text" name="ProductName" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Harga Produk:</label>
                <input type="text" name="Price" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <label>Jumlah Stok:</label>
            <input type="number" name="Quantity" class="form-control" min="0">
        </div>

        <div class="row mb-2">
            <div class="col-md-6">
                <label>Deskripsi:</label>
                <input type="text" name="Description" class="form-control">
            </div>
            <input type="hidden" name="is_best_seller" value="1">
            <div class="col-md-6">
                <label>Kategori:</label>
                <select name="Category" class="form-control">
                    <option value="Ulos">Ulos</option>
                    <option value="Tenun">Tenun</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
        </div>
        <div class="mb-2">
            <label>Gambar Utama:</label>
            <input type="file" name="ImageMain" class="form-control">
        </div>
        <div class="mb-2">
            <label>Gambar Lainnya:</label>
            <input type="file" name="ImageOthers[]" class="form-control" multiple>
        </div>
        <button type="submit" class="btn btn-danger">Tambah</button>
        <a href="{{ route('products.best') }}" class="btn btn-dark">Kembali</a>
    </form>
</div>

<style>
    /* Enhanced Navigation Buttons Styling with Better Active Indicators */
    
    /* Navigation Container */
    .nav-buttons-container {
        display: flex;
        gap: 15px;
        margin-bottom: 25px;
        padding: 5px;
        position: relative;
    }
    
    /* Base Button Style */
    .nav-btn {
        background-color: #2d3748;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 15px;
        text-decoration: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 1;
    }
    
    /* Hover Effect */
    .nav-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }
    
    /* Button Backgrounds */
    .nav-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, #4a5568, #2d3748);
        z-index: -1;
        transition: all 0.3s ease;
    }
    
    .nav-btn:hover::before {
        background: linear-gradient(45deg, #2d3748, #1a202c);
    }
    
    /* Active Button Style - ENHANCED */
    .nav-btn.active {
        background-color: transparent;
        color: white;
        box-shadow: 0 8px 15px rgba(66, 153, 225, 0.3);
        transform: translateY(-3px);
    }
    
    .nav-btn.active::before {
        background: linear-gradient(45deg, #3182ce, #4299e1);
    }
    
    /* Button Icon */
    .nav-btn i {
        margin-right: 8px;
        font-size: 16px;
    }
    
    /* Active Indicator Line - ENHANCED */
    .nav-btn::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 3px;
        background-color: #4299e1;
        transition: all 0.3s ease;
        transform: translateX(-50%);
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
