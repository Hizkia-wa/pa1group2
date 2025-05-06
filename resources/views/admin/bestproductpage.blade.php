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
</div>

<div class="nav-container">
    <a href="{{ route('products.best.create') }}" class="nav-btn add-btn {{ request()->routeIs('products.best.create') ? 'active' : '' }}">
        <i class="fas fa-plus"></i> Tambah Produk
    </a>
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

.nav-btn.add-btn {
    display: flex;
    align-items: center;
    padding: 8px 15px; /* Atur padding agar tombol tidak terlalu panjang */
    background-color: #DAA520;
    color: white;
    border-radius: 8px;
    font-weight: bold;
    text-decoration: none;
    transition: background 0.3s ease;
}

.nav-btn.add-btn:hover {
    background-color: #b48a1b;
}

.nav-btn.add-btn i {
    margin-right: 5px; /* Memberikan jarak antara ikon dan teks */
}

.nav-btn.add-btn.active {
    background-color: #b48a1b; /* Mengubah warna saat aktif */
}

.nav-container {
    display: flex;
    justify-content: flex-end; /* Membuat tombol berada di sebelah kanan */
    margin: 20px;
}

/* NAVIGATION BUTTONS - Konsisten dengan Produk Utama */
.nav-buttons-container {
    display: flex;
    justify-content: flex-start;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 25px;
}

.nav-btn {
    display: flex;
    align-items: center;
    padding: 10px 18px;
    font-weight: 600;
    font-size: 14px;
    border: none;
    border-radius: 10px;
    background: linear-gradient(135deg, #2d3748, #1a202c);
    color: white;
    text-decoration: none;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    position: relative;
    transition: all 0.3s ease;
}

.nav-btn i {
    margin-right: 8px;
    font-size: 16px;
}

.nav-btn:hover {
    background: linear-gradient(135deg, #4a5568, #2d3748);
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(0,0,0,0.15);
}

.nav-btn.active {
    background: linear-gradient(135deg, #3182ce, #2b6cb0);
    box-shadow: 0 6px 15px rgba(49, 130, 206, 0.5);
    transform: translateY(-3px);
}

.nav-btn.active::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 50%;
    transform: translateX(-50%);
    width: 60%;
    height: 4px;
    border-radius: 2px;
    background-color: #63b3ed;
}

.nav-btn.add-btn {
    background: linear-gradient(135deg, #38a169, #2f855a);
}

.nav-btn.add-btn:hover {
    background: linear-gradient(135deg, #2f855a, #276749);
}

.nav-btn.add-btn.active {
    background: linear-gradient(135deg, #2f855a, #276749);
}
</style>
@endsection
