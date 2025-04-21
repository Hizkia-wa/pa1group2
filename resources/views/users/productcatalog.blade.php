@extends('layouts.User')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-center text-2xl font-bold mb-8">
        Temukan koleksi Ulos berkualitas tinggi dari <br> berbagai daerah Toba
    </h2>

    {{-- Search & Filter --}}
    <form method="GET" action="{{ route('user.product.catalog') }}" class="flex flex-col md:flex-row items-center justify-between gap-4 mb-8">
        <div class="flex w-full md:w-1/2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari ulos..." class="w-full border border-gray-300 rounded-l px-4 py-2 focus:outline-none">
            <button type="submit" class="bg-gray-200 px-4 py-2 rounded-r">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.9 14.32a8 8 0 111.414-1.414l4.387 4.387a1 1 0 01-1.414 1.414l-4.387-4.387zM14 8a6 6 0 11-12 0 6 6 0 0112 0z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        <div class="flex gap-4 w-full md:w-auto">
            <select name="category" class="border border-gray-300 rounded px-3 py-2 text-sm">
                <option value="">Kategori</option>
                <option value="Pernikahan" {{ request('category') == 'Pernikahan' ? 'selected' : '' }}>Ulos Pernikahan</option>
                <option value="Dukacita" {{ request('category') == 'Dukacita' ? 'selected' : '' }}>Ulos Dukacita</option>
                <option value="Lahiran" {{ request('category') == 'Lahiran' ? 'selected' : '' }}>Ulos Lahiran</option>
            </select>

            <select name="sort" class="border border-gray-300 rounded px-3 py-2 text-sm">
                <option value="">Urutkan</option>
                <option value="low" {{ request('sort') == 'low' ? 'selected' : '' }}>Harga Terendah</option>
                <option value="high" {{ request('sort') == 'high' ? 'selected' : '' }}>Harga Tertinggi</option>
                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
            </select>
        </div>
    </form>

    {{-- Produk --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @forelse ($products as $product)
        <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
        <div class="bg-white rounded-lg shadow hover:shadow-lg transition w-full">
                @php
                    $images = json_decode($product->Images, true);
                    $imagePath = isset($images[0]) ? asset('storage/' . $images[0]) : asset('images/default.png');
                @endphp
                <img src="{{ $imagePath }}" alt="{{ $product->ProductName }}" class="w-full h-full object-cover">
            </div>
            <div class="p-4 flex flex-col justify-between h-[200px]">
                <div class="mb-2">
                    <a href="{{ route('user.product.detail', $product->id) }}" class="font-semibold text-gray-800 text-base hover:text-blue-600 block truncate">
                        {{ $product->ProductName }}
                    </a>
                    <p class="text-sm font-medium text-black mt-1">Rp. {{ number_format($product->Price, 0, ',', '.') }}</p>
                    <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $product->Description }}</p>
                </div>
                <div class="flex space-x-2 mt-auto">
                    <a href="{{ route('user.product.detail', $product->id) }}" class="flex-1 text-center bg-blue-700 text-white text-sm py-1 rounded hover:bg-blue-800">
                        Beli
                    </a>
                    <form class="add-to-cart-form flex-1">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="size" value="200 x 50 cm">
                        <button type="submit" class="w-full border border-blue-700 text-blue-700 text-sm py-1 rounded hover:bg-blue-50 flex justify-center items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 7h13L17 13M7 13H5.4M17 13l1.5 7M9 21a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z"/>
                            </svg>
                            + Keranjang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <p class="text-center col-span-full">Produk tidak ditemukan.</p>
    @endforelse
</div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                success: function () {
                    alert('Produk berhasil ditambahkan ke keranjang!');
                },
                error: function () {
                    alert('Terjadi kesalahan saat menambahkan ke keranjang.');
                }
            });
        });
    });
</script>
@endsection
