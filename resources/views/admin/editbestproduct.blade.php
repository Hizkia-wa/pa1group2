@extends('layouts.Admin')

@section('content')
<div class="container">
    <div class="mb-4">
        <a href="{{ route('products.index') }}" class="btn btn-dark">Produk Kita</a>
        <a href="{{ route('products.best') }}" class="btn btn-dark active">Produk Laris</a>
        <a href="{{ route('products.best.create') }}" class="btn btn-dark">Tambah Produk</a>
    </div>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="hidden" name="is_best_seller" value="1">

        <div class="row mb-2">
            <div class="col-md-6">
                <label>Nama Produk:</label>
                <input type="text" name="ProductName" class="form-control" value="{{ $product->ProductName }}">
            </div>
            <div class="col-md-6">
                <label>Harga Produk:</label>
                <input type="text" name="Price" class="form-control" value="{{ $product->Price }}">
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6">
                <label>Deskripsi:</label>
                <input type="text" name="Description" class="form-control" value="{{ $product->Description }}">
            </div>
            <div class="col-md-6">
                <label>Kategori:</label>
                <select name="Category" class="form-control">
                    <option value="Ulos" {{ $product->Category == 'Ulos' ? 'selected' : '' }}>Ulos</option>
                    <option value="Tenun" {{ $product->Category == 'Tenun' ? 'selected' : '' }}>Tenun</option>
                    <option value="Lainnya" {{ $product->Category == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6">
                <label>Jumlah Stok:</label>
                <input type="number" name="Quantity" class="form-control" value="{{ $product->Quantity }}">
            </div>
        </div>

        <div class="mb-2">
            <label>Tambah Gambar Utama:</label>
            <input type="file" name="ImageMain" class="form-control">
        </div>
        <div class="mb-2">
            <label>Tambah Gambar Lainnya:</label>
            <input type="file" name="ImageOthers[]" class="form-control" multiple>
        </div>

        <div class="mb-2">
            <label>Gambar Lama:</label>
            <div class="row">
                @php $images = json_decode($product->Images, true); @endphp
                @if(!empty($images))
                    @foreach($images as $img)
                        <div class="col-md-2 mb-2">
                            <img src="{{ asset('storage/app/public/' . $img) }}" class="img-fluid rounded">
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-danger">Simpan Perubahan</button>
        <a href="{{ route('products.best') }}" class="btn btn-dark">Kembali</a>
    </form>
</div>
@endsection
