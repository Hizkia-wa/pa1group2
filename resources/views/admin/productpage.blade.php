@extends('layouts.Admin')

@section('content')
<div class="container">
    <div class="mb-4">
        <a href="{{ route('products.index') }}" class="btn btn-dark">Produk Kita</a>
        <a href="#" class="btn btn-dark">Produk Laris</a>
        <a href="{{ route('products.create') }}" class="btn btn-dark">Tambah Produk</a>
    </div>

    <table class="table table-bordered bg-white">
        <thead>
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
                    @if(!empty($product->Images) && is_array($product->Images))
                        <img src="{{ asset('storage/' . $product->Images[0]) }}" width="60" alt="Gambar">
                    @endif
                </td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger">Hapus</button>
                    </form>
                    <a href="#" class="btn btn-warning">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
