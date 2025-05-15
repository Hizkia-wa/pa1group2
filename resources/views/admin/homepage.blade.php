@extends('layouts.Admin')

@section('content')
    <!-- Sambutan -->
    <div class="bg-white rounded-3 shadow-sm p-4 mb-4">
        <h5 class="text-dark fw-semibold mb-0">Selamat Datang, Admin!</h5>
    </div>

    <!-- Kartu Ringkasan -->
    <div class="row mb-4">
        @php
            $cards = [
                [
                    'title' => 'Jumlah Produk',
                    'count' => $jumlahProduk,
                    'color' => 'primary',
                    'icon' => 'bi-box',
                    'route' => route('products.index')
                ],
                [
                    'title' => 'Jumlah Customer',
                    'count' => $jumlahCustomer,
                    'color' => 'success',
                    'icon' => 'bi-people',
                    'route' => '#'
                ],
                [
                    'title' => 'Jumlah Order',
                    'count' => $jumlahOrder,
                    'color' => 'warning',
                    'icon' => 'bi-cart',
                    'route' => route('admin.orders')
                ],
                [
                    'title' => 'Jumlah Review',
                    'count' => $jumlahReview,
                    'color' => 'danger',
                    'icon' => 'bi-star',
                    'route' => route('admin.reviews')
                ],
            ];
        @endphp

        @foreach ($cards as $card)
            <div class="col-md-3 mb-4">
                <div class="card border-0 rounded-3 shadow-sm h-100">
                    <div class="card-body p-0">
                        <div class="p-3 text-white bg-{{ $card['color'] }} bg-gradient">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1 opacity-75">{{ $card['title'] }}</h6>
                                    <h3 class="fw-bold mb-0">{{ $card['count'] }}</h3>
                                </div>
                                <div class="bg-white bg-opacity-25 p-3 rounded-circle">
                                    <i class="bi {{ $card['icon'] }} fs-4 text-white"></i>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 bg-white border-top border-2 border-{{ $card['color'] }}">
                            <a href="{{ $card['route'] }}" class="text-{{ $card['color'] }} small fw-semibold text-decoration-none">
                                Lihat Detail <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Penjelasan Admin -->
    <div class="card border-0 rounded-3 shadow-sm mb-4">
        <div class="card-header bg-white border-bottom border-3 border-primary">
            <h5 class="fw-bold text-primary mb-0">Apa yang Bisa Anda Lakukan?</h5>
        </div>
        <div class="card-body bg-light bg-opacity-50 p-4">
            <p class="text-secondary">
                Sebagai admin, Anda memiliki akses penuh untuk mengelola berbagai aktivitas penting di platform ini. Berikut adalah beberapa tugas utama:
            </p>

            @php
                $roles = [
                    [
                        'icon' => 'bi-pen',
                        'title' => 'Mengelola Ulasan',
                        'desc' => 'Anda bisa menghapus ulasan yang tidak sesuai atau memulihkan ulasan yang telah dihapus.',
                        'color' => 'primary',
                    ],
                    [
                        'icon' => 'bi-box',
                        'title' => 'CRUD Produk',
                        'desc' => 'Anda dapat menambah, mengedit, dan menghapus produk di katalog.',
                        'color' => 'success',
                    ],
                    [
                        'icon' => 'bi-check-circle',
                        'title' => 'Konfirmasi Pesanan',
                        'desc' => 'Anda memiliki wewenang untuk mengonfirmasi pesanan dan memastikan kelancarannya.',
                        'color' => 'warning',
                    ],
                ];
            @endphp

            @foreach ($roles as $role)
                <div class="bg-white rounded p-3 shadow-sm mb-3">
                    <div class="d-flex">
                        <div class="bg-{{ $role['color'] }} bg-opacity-10 p-2 rounded me-3">
                            <i class="bi {{ $role['icon'] }} text-{{ $role['color'] }}"></i>
                        </div>
                        <div>
                            <h6 class="fw-semibold">{{ $role['title'] }}</h6>
                            <p class="mb-0 text-secondary">{{ $role['desc'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="alert alert-info border-0 rounded-3 mt-3">
                <i class="bi bi-info-circle me-2"></i>
                Semua aktivitas ini bertujuan untuk menjaga pengalaman belanja pelanggan tetap aman dan nyaman.
            </div>
        </div>
    </div>

    <!-- Aksi Utama -->
    <div class="row">
        @php
            $actions = [
                [
                    'title' => 'Mengelola Ulasan',
                    'desc' => 'Hapus ulasan yang tidak sesuai dan pulihkan ulasan yang telah dihapus.',
                    'icon' => 'bi-pen',
                    'color' => 'primary',
                    'route' => route('admin.reviews')
                ],
                [
                    'title' => 'CRUD Produk',
                    'desc' => 'Kelola produk dalam katalog seperti menambah, memperbarui, atau menghapus.',
                    'icon' => 'bi-boxes',
                    'color' => 'success',
                    'route' => route('products.index')
                ],
                [
                    'title' => 'Konfirmasi Pesanan',
                    'desc' => 'Periksa dan konfirmasi pesanan yang masuk untuk memastikan pengiriman tepat waktu.',
                    'icon' => 'bi-check-circle',
                    'color' => 'warning',
                    'route' => route('admin.orders')
                ],
            ];
        @endphp

        @foreach ($actions as $action)
            <div class="col-md-4 mb-4">
                <div class="card border-0 rounded-3 shadow-sm h-100">
                    <div class="card-header text-center bg-{{ $action['color'] }} bg-opacity-10 border-0 pt-4 pb-3">
                        <div class="d-inline-block bg-white p-3 rounded-circle shadow-sm mb-2">
                            <i class="bi {{ $action['icon'] }} fs-3 text-{{ $action['color'] }}"></i>
                        </div>
                        <h5 class="mt-2 text-{{ $action['color'] }} fw-semibold">{{ $action['title'] }}</h5>
                    </div>
                    <div class="card-body text-center px-4 pb-0">
                        <p class="text-secondary">{{ $action['desc'] }}</p>
                    </div>
                    <div class="card-footer border-0 bg-white text-center p-3">
                        <a href="{{ $action['route'] }}" class="btn btn-outline-{{ $action['color'] }} rounded-pill px-4">
                            <i class="bi bi-arrow-right-circle me-2"></i>{{ $action['title'] }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
