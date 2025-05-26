@extends('layouts.customer')

@section('content')
<div class="container mt-5 d-flex">
    {{-- Daftar Produk di Keranjang --}}
    <div class="w-50 me-4">
        <h3 class="mb-4 fw-bold">Keranjang</h3>

        <form action="{{ route('customer.cart.checkout') }}" method="POST">
            @csrf

            @foreach ($cartWithProduct as $item)
            @php
                $product = $item->product;
                $images = json_decode($product->Images, true);
                $imagePath = isset($images[0]) ? asset('storage/app/public/' . $images[0]) : asset('images/default.png');
            @endphp

            <div class="card mb-3 p-3 d-flex flex-row align-items-center" style="border: 1px solid #ddd; border-radius: 10px;">
                <!-- Checkbox -->
                <div class="form-check me-3">
                    <input 
                        type="checkbox" 
                        name="selected[]" 
                        value="{{ $item->id }}-{{ $product->id }}" 
                        class="form-check-input cart-checkbox"
                        data-quantity="{{ $item->Quantity }}" 
                        data-product-name="{{ $product->ProductName }}"
                        data-product-price="{{ $product->Price }}"
                    >
                </div>

                <!-- Gambar Produk -->
                <div style="width: 100px; height: 100px; overflow: hidden;" class="me-3">
                    <img src="{{ $imagePath }}" alt="{{ $product->ProductName }}" class="w-100 h-100 object-fit-cover">
                </div>

                <!-- Detail Produk -->
                <div class="flex-grow-1">
                    <h5 class="fw-bold mb-1">{{ $product->ProductName }}</h5>
                    <div class="text-danger fw-bold mb-1">Rp.{{ number_format($product->Price, 0, ',', '.') }}</div>
                    <div class="mb-2">Jumlah: {{ $item->Quantity }}</div>
                </div>

                <!-- Hapus -->
                <form action="{{ route('customer.cart.remove', $item->id) }}" method="POST" class="ms-3">
                    @csrf
                    <button class="btn btn-outline-danger btn-sm">Hapus</button>
                </form>
            </div>
            @endforeach

            <button type="submit" class="btn btn-success w-100 mb-3">Checkout</button>
        </form>
    </div>

    {{-- Form Pemesanan --}}
    <div class="w-50">
        <h4 class="fw-bold mb-4">Form Pemesanan</h4>
        <form action="{{ route('customer.cart.checkout') }}" method="POST">
            @csrf
            <h6 class="fw-bold">Informasi Pembeli</h6>
            <div class="mb-2">
                <input type="text" name="CustomerName" class="form-control" placeholder="Nama" required>
            </div>
            <div class="mb-2">
                <input type="email" name="Email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="text" name="Phone" class="form-control" placeholder="Telepon" required>
            </div>

            <h6 class="fw-bold">Informasi Pengiriman</h6>
            <div class="mb-2">
                <input type="text" name="City" class="form-control" placeholder="Kabupaten/Kota" required>
            </div>
            <div class="mb-2">
                <input type="text" name="District" class="form-control" placeholder="Kecamatan" required>
            </div>
            <div class="mb-2">
                <input type="text" name="Street" class="form-control" placeholder="Jalan" required>
            </div>
            <div class="mb-3">
                <input type="text" name="PostalCode" class="form-control" placeholder="Kode Pos" required>
            </div>

            <button type="submit" class="btn btn-success w-100 mb-3">Pesan Sekarang</button>
        </form>
    </div>
</div>
@endsection
