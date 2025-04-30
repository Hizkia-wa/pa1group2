@extends('layouts.Admin')

@section('content')
    <!-- Header dengan Sambutan Admin -->
    <div class="bg-white rounded-3 shadow-sm p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="text-dark fw-semibold mb-0">Selamat Datang, Admin!</h5>
            <div class="dropdown admin-dropdown">
                <button class="btn btn-light border dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <img src="https://i.pravatar.cc/30" alt="Admin" class="rounded-circle"> Admin
                </button>
                <div class="dropdown-menu shadow-sm border-0">
                    <a class="dropdown-item" href="{{ route('admin.changePasswordForm') }}">Ubah Password</a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Info Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-4">
            <div class="card border-0 rounded-3 overflow-hidden">
                <div class="card-body p-0">
                    <div class="bg-primary bg-gradient text-white p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1 opacity-75">Jumlah Produk</h6>
                                <h3 class="fw-bold mb-0">{{ $jumlahProduk }}</h3>
                            </div>
                            <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                                <i class="bi bi-box fs-4 text-white"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 bg-white border-top border-primary border-2">
                        <a href="{{ route('products.index') }}" class="text-primary small fw-semibold text-decoration-none">
                            Lihat Detail <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card border-0 rounded-3 overflow-hidden">
                <div class="card-body p-0">
                    <div class="bg-success bg-gradient text-white p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1 opacity-75">Jumlah Customer</h6>
                                <h3 class="fw-bold mb-0">{{ $jumlahCustomer }}</h3>
                            </div>
                            <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                                <i class="bi bi-people fs-4 text-white"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 bg-white border-top border-success border-2">
                        <a href="#" class="text-success small fw-semibold text-decoration-none">
                            Lihat Detail <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card border-0 rounded-3 overflow-hidden">
                <div class="card-body p-0">
                    <div class="bg-warning bg-gradient text-white p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1 opacity-75">Jumlah Order</h6>
                                <h3 class="fw-bold mb-0">{{ $jumlahOrder }}</h3>
                            </div>
                            <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                                <i class="bi bi-cart fs-4 text-white"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 bg-white border-top border-warning border-2">
                        <a href="{{ route('admin.orders') }}" class="text-warning small fw-semibold text-decoration-none">
                            Lihat Detail <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card border-0 rounded-3 overflow-hidden">
                <div class="card-body p-0">
                    <div class="bg-danger bg-gradient text-white p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1 opacity-75">Jumlah Review</h6>
                                <h3 class="fw-bold mb-0">{{ $jumlahReview }}</h3>
                            </div>
                            <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                                <i class="bi bi-star fs-4 text-white"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 bg-white border-top border-danger border-2">
                        <a href="{{ route('admin.reviews') }}" class="text-danger small fw-semibold text-decoration-none">
                            Lihat Detail <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Penjelasan Aktivitas Admin -->
    <div class="card border-0 rounded-3 shadow-sm mb-4">
        <div class="card-header bg-white border-bottom border-3 border-primary">
            <h5 class="card-title text-primary fw-bold mb-0">Apa yang Bisa Anda Lakukan?</h5>
        </div>
        <div class="card-body bg-light bg-opacity-25 p-4">
            <p class="card-text">
                Sebagai admin, Anda memiliki akses penuh untuk mengelola berbagai aktivitas penting di platform ini. Berikut adalah beberapa tugas utama yang dapat Anda lakukan:
            </p>
            <div class="bg-white rounded p-3 shadow-sm mb-3">
                <div class="d-flex">
                    <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                        <i class="bi bi-pen text-primary"></i>
                    </div>
                    <div>
                        <h6 class="fw-semibold">Mengelola Ulasan</h6>
                        <p class="mb-0 text-secondary">Anda bisa menghapus ulasan yang tidak sesuai atau memulihkan ulasan yang telah dihapus sebelumnya.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded p-3 shadow-sm mb-3">
                <div class="d-flex">
                    <div class="bg-success bg-opacity-10 p-2 rounded me-3">
                        <i class="bi bi-box text-success"></i>
                    </div>
                    <div>
                        <h6 class="fw-semibold">CRUD Produk</h6>
                        <p class="mb-0 text-secondary">Anda dapat membuat, membaca, memperbarui, atau menghapus produk yang ada di katalog. Selain itu, Anda juga bisa memulihkan produk yang sudah dihapus.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded p-3 shadow-sm mb-3">
                <div class="d-flex">
                    <div class="bg-warning bg-opacity-10 p-2 rounded me-3">
                        <i class="bi bi-check-circle text-warning"></i>
                    </div>
                    <div>
                        <h6 class="fw-semibold">Konfirmasi Pesanan</h6>
                        <p class="mb-0 text-secondary">Anda memiliki wewenang untuk mengonfirmasi status pesanan yang masuk dan memastikan kelancaran proses transaksi.</p>
                    </div>
                </div>
            </div>

            <div class="alert alert-info rounded-3 border-0 mt-3">
                <i class="bi bi-info-circle me-2"></i>
                Semua aktivitas ini dilakukan untuk memastikan pengalaman belanja yang lancar dan aman bagi pelanggan.
            </div>
        </div>
    </div>

    <!-- Aktivitas Admin dengan Ikon dan Tombol Aksi -->
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-0 rounded-3 shadow-sm h-100">
                <div class="card-header text-center bg-primary bg-opacity-10 border-0 pt-4 pb-3">
                    <div class="d-inline-block bg-white p-3 rounded-circle shadow-sm mb-2">
                        <i class="bi bi-pen fs-3 text-primary"></i>
                    </div>
                    <h5 class="card-title mt-2 text-primary fw-semibold">Mengelola Ulasan</h5>
                </div>
                <div class="card-body text-center p-4">
                    <p class="card-text text-secondary">Hapus ulasan yang tidak sesuai dan pulihkan ulasan yang telah dihapus untuk menjaga kualitas ulasan produk.</p>
                </div>
                <div class="card-footer border-0 bg-white text-center p-3">
                    <a href="{{ route('admin.reviews') }}" class="btn btn-outline-primary rounded-pill px-4">
                        <i class="bi bi-arrow-right-circle me-2"></i>Kelola Ulasan
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 rounded-3 shadow-sm h-100">
                <div class="card-header text-center bg-success bg-opacity-10 border-0 pt-4 pb-3">
                    <div class="d-inline-block bg-white p-3 rounded-circle shadow-sm mb-2">
                        <i class="bi bi-boxes fs-3 text-success"></i>
                    </div>
                    <h5 class="card-title mt-2 text-success fw-semibold">CRUD Produk</h5>
                </div>
                <div class="card-body text-center p-4">
                    <p class="card-text text-secondary">Kelola produk yang ada di katalog, mulai dari menambah, mengedit, hingga menghapus produk.</p>
                </div>
                <div class="card-footer border-0 bg-white text-center p-3">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-success rounded-pill px-4">
                        <i class="bi bi-arrow-right-circle me-2"></i>Kelola Produk
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 rounded-3 shadow-sm h-100">
                <div class="card-header text-center bg-warning bg-opacity-10 border-0 pt-4 pb-3">
                    <div class="d-inline-block bg-white p-3 rounded-circle shadow-sm mb-2">
                        <i class="bi bi-check-circle fs-3 text-warning"></i>
                    </div>
                    <h5 class="card-title mt-2 text-warning fw-semibold">Konfirmasi Pesanan</h5>
                </div>
                <div class="card-body text-center p-4">
                    <p class="card-text text-secondary">Periksa dan konfirmasi pesanan yang masuk untuk memastikan pesanan dikirim tepat waktu.</p>
                </div>
                <div class="card-footer border-0 bg-white text-center p-3">
                    <a href="{{ route('admin.orders') }}" class="btn btn-outline-warning rounded-pill px-4">
                        <i class="bi bi-arrow-right-circle me-2"></i>Konfirmasi Pesanan
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection