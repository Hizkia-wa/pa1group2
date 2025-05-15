@extends('layouts.admin')

@section('content')
<div class="container">
    <h3 class="mb-4">Riwayat Produk</h3>

    <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Gambar Utama</th>
                <th>Aksi Admin</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deletedProducts as $index => $product)
            <tr class="text-center">
                <td>{{ $index + 1 }}</td>
                <td>{{ $product->ProductName }}</td>
                <td>{{ $product->Category }}</td>
                <td>
                    @php
                        $images = json_decode($product->Images, true);
                        $mainImage = $images[0] ?? null;
                    @endphp
                    @if($mainImage)
                        <img src="{{ asset('storage/' . $mainImage) }}" alt="Gambar Utama" width="50">
                    @else
                        Tidak Ada Gambar
                    @endif
                </td>
                <td>
                <form action="{{ route('products.restore', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-dark">Pulihkan</button>
                    </form>
                    <a href="{{ route('products.riwayat', $product->id) }}" class="btn btn-warning text-white">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
