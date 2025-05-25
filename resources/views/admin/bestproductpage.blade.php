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
            <a href="{{ route('products.best.create') }}" class="nav-btn add-btn {{ request()->routeIs('products.best.create') ? 'active' : '' }}">
                <i class="fas fa-plus-circle"></i> Tambah Produk Laris
            </a>
        </div>
    </div>
</div>

<div class="table-responsive mt-4">
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
                        <img src="{{ asset('storage/app/public/' . $images[0]) }}" width="100" class="img-thumbnail shadow-sm" alt="Product Image">
                    @endif
                </td>
                <td>
                    <a href="{{ route('bestproducts.edit', $product->id) }}" class="btn btn-sm btn-warning mb-1">Edit</a>
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

/* Container grup kategori */
.nav-category-group, .nav-action-group {
    width: 100%;
}

/* Container tombol navigasi */
.nav-buttons-container {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

/* Tombol navigasi dasar */
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

/* Tombol Produk Kita - Style */
.nav-btn.product-main {
    background: linear-gradient(135deg, #3182ce, #2b6cb0);
    color: white;
}

.nav-btn.product-main:hover {
    background: linear-gradient(135deg, #2b6cb0, #1e4e8c);
    transform: translateY(-3px);
    box-shadow: 0 6px 12px rgba(49, 130, 206, 0.4);
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
}

.nav-btn.add-btn.active {
    background: linear-gradient(135deg, #276749, #22543d);
    box-shadow: 0 6px 12px rgba(56, 161, 105, 0.6);
}

/* Indikator aktif untuk semua tombol */
.nav-btn.active::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 50%;
    transform: translateX(-50%);
    width: 60%;
    height: 4px;
    border-radius: 2px;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

/* Responsif untuk layar kecil */
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
}
</style>
@endsection