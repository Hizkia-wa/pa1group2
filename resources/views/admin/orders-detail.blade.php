@extends('layouts.Admin')

@section('content')
<div class="container mt-4">
    <a href="{{ route('admin.orders') }}" class="btn btn-outline-dark mb-3">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>

    <div class="card shadow-sm p-4">
        <h3 class="mb-4 fw-bold border-bottom pb-2">Detail Pesanan</h3>

        @php
            // Total semua item (jika ada lebih dari satu)
            $totalSeluruh = $order->Quantity * $order->product->Price;
        @endphp

        <div class="mb-4 border-bottom pb-3">
            <div class="d-flex align-items-center gap-3">
            <img src="{{ asset('storage/' . $order->product->ImagePath) }}" 
            alt="Gambar Produk" 
     style="width: 100px; height: auto; border-radius: 10px;">

                <div>
                    <h5 class="mb-1">{{ $order->product->ProductName }}</h5>
                    <p class="mb-0">Size: {{ $order->Size }}</p>
                    <p class="mb-0">Jumlah: {{ $order->Quantity }}</p>
                    <p class="mb-0">Harga Satuan: Rp{{ number_format($order->product->Price, 0, ',', '.') }}</p>
                    <p class="fw-semibold mt-1">Total: Rp{{ number_format($order->Quantity * $order->product->Price, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        {{-- Jika kamu ingin menampilkan lebih dari 1 produk dalam 1 pesanan, pakai loop di sini --}}

        <h4 class="fw-bold border-bottom pb-2 mt-5">Detail Pemesan</h4>
        <div class="mt-3">
            <p><strong>Nama:</strong> {{ $order->CustomerName }}</p>
            <p><strong>Email:</strong> {{ $order->Email }}</p>
            <p><strong>Telepon:</strong> {{ $order->Phone }}</p>
            <p><strong>Alamat:</strong> {{ $order->Address }}, {{ $order->District }}, {{ $order->City }}, {{ $order->PostalCode }}</p>
        </div>
    </div>
</div>
@endsection
