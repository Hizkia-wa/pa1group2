@extends('layouts.Admin')

@section('content')
<div class="container">
    <div class="mb-4">
        <a href="{{ route('products.index') }}" class="btn btn-dark">Produk Kita</a>
        <a href="#" class="btn btn-dark">Produk Laris</a>
        <a href="{{ route('products.create') }}" class="btn btn-dark">Tambah Produk</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-2">
            <div class="col-md-6">
                <label>Nama Produk:</label>
                <input type="text" name="ProductName" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Gambar Utama:</label>
                <input type="file" name="ImageMain" class="form-control">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6">
                <label>Harga Produk:</label>
                <input type="text" name="Price" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Jumlah Stok:</label>
                <input type="number" name="Quantity" class="form-control" min="0" required>
            </div>
            <div class="col-md-6">
                <label>Gambar Lainnya:</label>
                <input type="file" name="ImageOthers[]" class="form-control" multiple>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6">
                <label>Deskripsi:</label>
                <input type="text" name="Description" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Kategori:</label>
                <select name="Category" class="form-control">
                    <option value="Ulos">Ulos</option>
                    <option value="Tenun">Tenun</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-danger">Tambah</button>
        <a href="{{ route('products.index') }}" class="btn btn-dark">Kembali</a>
    </form>
</div>
@endsection
