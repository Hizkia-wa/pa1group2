@extends('layouts.Admin')

@section('content')
<div class="dashboard-header">
    <div class="page-title">
        <h2><i class="fas fa-store"></i> Manajemen Produk</h2>
    </div>
</div>

<div class="admin-navigation-container">
    <!-- Kategori Produk Navigation -->
    <div class="nav-category-group">
        <h4 class="nav-group-title">Kategori Produk</h4>
        <div class="nav-buttons-container">
            <a href="{{ route('products.index') }}" class="nav-btn product-main {{ request()->routeIs('products.index') ? 'active' : '' }}">
                <i class="fas fa-boxes"></i> Produk Kita
                @if(request()->routeIs('products.index'))
                    <span class="active-indicator"></span>
                @endif
            </a>
            <a href="{{ route('products.best') }}" class="nav-btn product-best {{ request()->routeIs('products.best') ? 'active' : '' }}">
                <i class="fas fa-fire"></i> Produk Laris
                @if(request()->routeIs('products.best'))
                    <span class="active-indicator"></span>
                @endif
            </a>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="nav-action-group">
        <h4 class="nav-group-title">Tindakan</h4>
        <div class="nav-container">
            <a href="{{ route('products.create') }}" class="nav-btn add-btn {{ request()->routeIs('products.best.create') ? 'active' : '' }}">
                <i class="fas fa-plus-circle"></i> Tambah Produk Kita
            </a>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered bg-white text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Gambar Utama</th>
                <th>Aksi Admin</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $index => $product)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $product->ProductName }}</td>
                <td>{{ $product->Category }}</td>
                <td>
                    @php $images = json_decode($product->Images, true); @endphp
                    @if (!empty($images) && isset($images[0]))
                        <img src="{{ asset('storage/' . $images[0]) }}" width="100" class="img-thumbnail shadow-sm" alt="Product Image">
                    @endif
                </td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning mb-1">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger mb-1">Hapus</button>
                    </form>
                    <a href="{{ route('product.detail', $product->id) }}" class="btn btn-sm btn-info mb-1">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<style>
/* Dashboard Header Styles */
.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #e2e8f0;
}

.page-title h2 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #2d3748;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

/* Container utama untuk navigasi admin */
.admin-navigation-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-bottom: 30px;
    background-color: #f8f9fa;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

/* Judul grup navigasi */
.nav-group-title {
    font-size: 14px;
    text-transform: uppercase;
    color: #6c757d;
    margin-bottom: 10px;
    font-weight: 600;
    letter-spacing: 0.5px;
    padding-left: 5px;
    border-left: 4px solid #4a5568;
}


.nav-category-group, .nav-action-group {
    width: 100%;
}

/* Container tombol navigasi */
.nav-buttons-container {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}


.nav-btn {
    display: flex;
    align-items: center;
    padding: 12px 20px;
    font-weight: 600;
    font-size: 14px;
    border: none;
    border-radius: 10px;
    text-decoration: none;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    position: relative;
}

.nav-btn i {
    margin-right: 10px;
    font-size: 16px;
}


.nav-btn.product-main {
    background: linear-gradient(135deg, #3182ce, #2b6cb0);
    color: white;
}

.nav-btn.product-main:hover {
    background: linear-gradient(135deg, #2b6cb0, #1e4e8c);
    transform: translateY(-3px);
    box-shadow: 0 6px 12px rgba(49, 130, 206, 0.4);
    color: white;
    text-decoration: none;
}

.nav-btn.product-main.active {
    background: linear-gradient(135deg, #1e4e8c, #153e75);
    box-shadow: 0 6px 12px rgba(49, 130, 206, 0.6);
}

/* Tombol Produk Laris - Style */
.nav-btn.product-best {
    background: linear-gradient(135deg, #ed8936, #dd6b20);
    color: white;
}

.nav-btn.product-best:hover {
    background: linear-gradient(135deg, #dd6b20, #c05621);
    transform: translateY(-3px);
    box-shadow: 0 6px 12px rgba(237, 137, 54, 0.4);
    color: white;
    text-decoration: none;
}

.nav-btn.product-best.active {
    background: linear-gradient(135deg, #c05621, #9c4221);
    box-shadow: 0 6px 12px rgba(237, 137, 54, 0.6);
}

/* Container untuk tombol aksi */
.nav-container {
    display: flex;
    justify-content: flex-start;
}

/* Tombol Tambah Produk - Style */
.nav-btn.add-btn {
    background: linear-gradient(135deg, #38a169, #2f855a);
    color: white;
    padding: 12px 22px;
    font-weight: 700;
}

.nav-btn.add-btn i {
    font-size: 18px;
}

.nav-btn.add-btn:hover {
    background: linear-gradient(135deg, #2f855a, #276749);
    transform: translateY(-3px);
    box-shadow: 0 6px 12px rgba(56, 161, 105, 0.4);
    color: white;
    text-decoration: none;
}

.nav-btn.add-btn.active {
    background: linear-gradient(135deg, #276749, #22543d);
    box-shadow: 0 6px 12px rgba(56, 161, 105, 0.6);
}

/* Indikator aktif untuk semua tombol */
.nav-btn.active .active-indicator {
    position: absolute;
    top: -6px;
    right: -6px;
    width: 14px;
    height: 14px;
    background-color: #38b2ac;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 9px;
    font-weight: bold;
    box-shadow: 0 0 8px rgba(56, 178, 172, 0.5);
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

/* TABLE STYLE */
.table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

.table thead {
    background-color: #2d3748;
    color: #fff;
    font-size: 15px;
}

.table th, .table td {
    padding: 12px 15px;
    text-align: left;
    vertical-align: middle;
}

.table tbody tr:nth-child(even) {
    background-color: #f7fafc;
}

.table tbody tr:hover {
    background-color: #edf2f7;
}

.table img {
    border-radius: 6px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

/* ACTION BUTTONS */
.btn-warning, .btn-danger, .btn-info {
    margin-right: 5px;
    border-radius: 6px;
    font-weight: 500;
}

.btn-warning {
    background-color: #f6ad55;
    border: none;
}

.btn-warning:hover {
    background-color: #dd6b20;
}

.btn-danger {
    background-color: #e53e3e;
    border: none;
}

.btn-danger:hover {
    background-color: #c53030;
}

.btn-info {
    background-color: #4299e1;
    border: none;
}

.btn-info:hover {
    background-color: #3182ce;
}

/* RESPONSIVE WRAPPING FOR SMALL SCREENS */
@media (max-width: 768px) {
    .admin-navigation-container {
        padding: 15px;
    }
    
    .nav-btn {
        padding: 10px 15px;
        font-size: 13px;
    }
    
    .nav-btn i {
        margin-right: 8px;
        font-size: 14px;
    }
    
    .nav-buttons-container {
        width: 100%;
        justify-content: space-between;
    }
    
    .nav-container {
        width: 100%;
    }
    
    .nav-btn.add-btn {
        width: 100%;
        justify-content: center;
    }
    
    .table th, .table td {
        font-size: 13px;
    }
    
    .btn {
        font-size: 12px;
        padding: 5px 8px;
    }
}
</style>

@endsection