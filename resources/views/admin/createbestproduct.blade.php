@extends('layouts.Admin')

@section('content')
<div class="container">
<div class="mb-4">
        <a href="{{ route('products.index') }}" class="btn btn-dark">Produk Kita</a>
        <a href="{{ route('products.best') }}" class="btn btn-dark active">Produk Laris</a>
        <a href="{{ route('products.best.create') }}" class="btn btn-dark">Tambah Produk</a>
    </div>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-2">
            <div class="col-md-6">
                <label>Nama Produk:</label>
                <input type="text" name="ProductName" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Harga Produk:</label>
                <input type="text" name="Price" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <label>Jumlah Stok:</label>
            <input type="number" name="Quantity" class="form-control" min="0">
        </div>

        <div class="row mb-2">
            <div class="col-md-6">
                <label>Deskripsi:</label>
                <input type="text" name="Description" class="form-control">
            </div>
            <input type="hidden" name="is_best_seller" value="1">
            <div class="col-md-6">
                <label>Kategori:</label>
                <select name="Category" class="form-control">
                    <option value="Ulos">Ulos</option>
                    <option value="Tenun">Tenun</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
        </div>
        <div class="mb-2">
            <label>Gambar Utama:</label>
            <input type="file" name="ImageMain" class="form-control">
        </div>
        <div class="mb-2">
            <label>Gambar Lainnya:</label>
            <input type="file" name="ImageOthers[]" class="form-control" multiple>
        </div>
        <button type="submit" class="btn btn-danger">Tambah</button>
        <a href="{{ route('products.best') }}" class="btn btn-dark">Kembali</a>
    </form>
</div>
@endsection
