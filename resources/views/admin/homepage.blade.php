@extends('layouts.Admin')

@section('content')
    <!-- Header dengan Sambutan Admin -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="text-secondary">Selamat Datang, Admin!</h5>
        <div class="dropdown admin-dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <img src="https://i.pravatar.cc/30" alt="Admin" class="rounded-circle"> Admin
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('admin.changePasswordForm') }}">Ubah Password</a>
                <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="dropdown-item">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Dashboard Info Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-4">
            <div class="card shadow-lg border-0 rounded bg-primary text-white">
                <div class="card-body text-center">
                    <h6>Jumlah Produk</h6>
                    <h3 class="fw-bold">{{ $jumlahProduk }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow-lg border-0 rounded bg-success text-white">
                <div class="card-body text-center">
                    <h6>Jumlah Customer</h6>
                    <h3 class="fw-bold">{{ $jumlahCustomer }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow-lg border-0 rounded bg-warning text-white">
                <div class="card-body text-center">
                    <h6>Jumlah Order</h6>
                    <h3 class="fw-bold">{{ $jumlahOrder }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow-lg border-0 rounded bg-danger text-white">
                <div class="card-body text-center">
                    <h6>Jumlah Review</h6>
                    <h3 class="fw-bold">{{ $jumlahReview }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Penjelasan Aktivitas Admin -->
    <div class="card shadow-lg mb-4 border-0 rounded">
        <div class="card-body">
            <h5 class="card-title text-primary">Apa yang Bisa Anda Lakukan?</h5>
            <p class="card-text">
                Sebagai admin, Anda memiliki akses penuh untuk mengelola berbagai aktivitas penting di platform ini. Berikut adalah beberapa tugas utama yang dapat Anda lakukan:
            </p>
            <ul>
                <li><strong>Mengelola Ulasan:</strong> Anda bisa menghapus ulasan yang tidak sesuai atau memulihkan ulasan yang telah dihapus sebelumnya.</li>
                <li><strong>CRUD Produk:</strong> Anda dapat membuat, membaca, memperbarui, atau menghapus produk yang ada di katalog. Selain itu, Anda juga bisa memulihkan produk yang sudah dihapus.</li>
                <li><strong>Konfirmasi Pesanan:</strong> Anda memiliki wewenang untuk mengonfirmasi status pesanan yang masuk dan memastikan kelancaran proses transaksi.</li>
            </ul>
            <p>
                Semua aktivitas ini dilakukan untuk memastikan pengalaman belanja yang lancar dan aman bagi pelanggan.
            </p>
        </div>
    </div>

    <!-- Aktivitas Admin dengan Ikon dan Tombol Aksi -->
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-lg border-0 rounded">
                <div class="card-body text-center">
                    <i class="bi bi-pen fs-2 mb-3 text-primary"></i>
                    <h5 class="card-title">Mengelola Ulasan</h5>
                    <p class="card-text">Hapus ulasan yang tidak sesuai dan pulihkan ulasan yang telah dihapus untuk menjaga kualitas ulasan produk.</p>
                    <a href="{{ route('admin.reviews') }}" class="btn btn-primary">Kelola Ulasan</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-lg border-0 rounded">
                <div class="card-body text-center">
                    <i class="bi bi-boxes fs-2 mb-3 text-success"></i>
                    <h5 class="card-title">CRUD Produk</h5>
                    <p class="card-text">Kelola produk yang ada di katalog, mulai dari menambah, mengedit, hingga menghapus produk.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-success">Kelola Produk</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-lg border-0 rounded">
                <div class="card-body text-center">
                    <i class="bi bi-check-circle fs-2 mb-3 text-warning"></i>
                    <h5 class="card-title">Konfirmasi Pesanan</h5>
                    <p class="card-text">Periksa dan konfirmasi pesanan yang masuk untuk memastikan pesanan dikirim tepat waktu.</p>
                    <a href="{{ route('admin.orders') }}" class="btn btn-warning">Konfirmasi Pesanan</a>
                </div>
            </div>
        </div>
    </div>
@endsection
