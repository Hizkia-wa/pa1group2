@extends('layouts.User')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="mb-6 text-center text-2xl font-bold">Katalog Produk</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($products as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden mx-auto max-w-[250px] w-full">
                {{-- Gambar Produk --}}
                <div class="w-full h-[200px] overflow-hidden">
                    @php
                        $images = json_decode($product->Images, true);
                        $imagePath = isset($images[0]) ? asset('storage/' . $images[0]) : asset('images/default.png');
                    @endphp
                    <img src="{{ $imagePath }}" alt="{{ $product->ProductName }}" class="w-full h-full object-cover">
                </div>

                {{-- Konten --}}
                <div class="p-4">
                    <a href="{{ route('user.product.detail', $product->id) }}" class="block text-base font-semibold text-gray-900 truncate hover:text-blue-700">
                        {{ $product->ProductName }}
                    </a>
                    <p class="text-sm text-gray-600 truncate">{{ $product->Description }}</p>
                    <p class="text-sm font-bold text-black mb-4">Rp. {{ number_format($product->Price, 0, ',', '.') }}</p>

                    {{-- Tombol --}}
                    <div class="flex space-x-2">
                        <a href="{{ route('user.product.detail', $product->id) }}"
                           class="flex-1 text-center py-1.5 bg-blue-700 text-white rounded hover:bg-blue-800 text-sm font-medium transition">
                            Beli
                        </a>

                        <form class="add-to-cart-form flex-1">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="size" value="200 x 50 cm">
                            <button type="submit" class="flex items-center justify-center w-full px-3 py-1.5 border border-blue-700 text-blue-700 rounded hover:bg-blue-50 transition text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 7h13L17 13M7 13H5.4M17 13l1.5 7M9 21a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z"/>
                                </svg>
                                + Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
{{-- jQuery CDN --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- Script AJAX untuk tambah ke keranjang --}}
<script>
    $(document).ready(function () {
        $('.add-to-cart-form').on('submit', function (e) {
            e.preventDefault();

            let form = $(this);
            let data = form.serialize();

            $.ajax({
                url: '{{ route('user.cart.add') }}',
                type: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (response) {
                    alert('Produk berhasil ditambahkan ke keranjang!');
                    // Tambahkan logic update UI di sini jika mau (misal badge jumlah)
                },
                error: function (xhr) {
                    alert('Terjadi kesalahan saat menambahkan ke keranjang.');
                }
            });
        });
    });
</script>
@endsection
