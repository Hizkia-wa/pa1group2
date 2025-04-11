@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 d-md-block bg-success sidebar vh-100">
            <div class="position-sticky">
                <ul class="nav flex-column mt-4">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white active bg-dark" href="{{ route('admin.products') }}">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.reviews') }}">Ulasan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.website') }}">Halaman Website</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-white dropdown-toggle" href="#" id="riwayatDropdown" role="button" data-bs-toggle="dropdown">
                            Riwayat ▼
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.riwayat.produk') }}">Riwayat Produk</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.riwayat.ulasan') }}">Riwayat Ulasan</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Konten utama -->
        <main class="col-md-10 ms-sm-auto px-4">
            <div class="mt-4">
                <h4>Tambah Produk Baru</h4>
            </div>

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                @csrf

                <div class="mb-3">
                    <label for="ProductName" class="form-label">Nama Produk:</label>
                    <input type="text" class="form-control" id="ProductName" name="ProductName" required>
                </div>

                <div class="mb-3">
                    <label for="Quantity" class="form-label">Jumlah Produk:</label>
                    <input type="number" class="form-control" id="Quantity" name="Quantity" min="0" required>
                </div>

                <div class="mb-3">
                    <label for="Category" class="form-label">Kategori:</label>
                    <input type="text" class="form-control" id="Category" name="Category" required>
                </div>

                <div class="mb-3">
                    <label for="Price" class="form-label">Harga Produk:</label>
                    <input type="number" step="0.01" class="form-control" id="Price" name="Price" required>
                </div>

                <div class="mb-3">
                    <label for="Description" class="form-label">Deskripsi:</label>
                    <textarea class="form-control" id="Description" name="Description" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="Images" class="form-label">Upload Gambar Produk:</label>
                    <input type="file" class="form-control" id="Images" name="Images[]" accept="image/*" multiple required>
                    <small class="text-muted">Kamu bisa mengupload lebih dari satu gambar sekaligus.</small>
                </div>

                <div class="d-flex">
                    <a href="{{ route('admin.products') }}" class="btn btn-danger me-2">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </main>
    </div>
</div>
@endsection
