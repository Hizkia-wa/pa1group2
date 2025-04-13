@extends('layouts.Admin')

@section('content')
<div class="container">
    <div class="mb-4">
        <a href="{{ route('products.index') }}" class="btn btn-dark active">Produk Kita</a>
        <a href="{{ route('products.best') }}" class="btn btn-dark">Produk Laris</a>
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

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row mb-2">
            <div class="col-md-6">
                <label>Nama Produk:</label>
                <input type="text" name="ProductName" value="{{ old('ProductName', $product->ProductName) }}" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Gambar Utama Baru (opsional):</label>
                <input type="file" name="ImageMain" class="form-control">
                @php $images = json_decode($product->Images, true); @endphp
                @if(!empty($images) && isset($images[0]))
                    <img src="{{ asset('storage/' . $images[0]) }}" width="80" class="mt-2">
                @endif
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6">
                <label>Harga Produk:</label>
                <input type="text" name="Price" value="{{ old('Price', $product->Price) }}" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Jumlah Stok:</label>
                <input type="number" name="Quantity" value="{{ old('Quantity', $product->Quantity) }}" class="form-control" min="0" required>
            </div>
            <div class="col-md-6 mt-2">
                <label>Gambar Lainnya Baru (opsional):</label>
                <input type="file" name="ImageOthers[]" class="form-control" multiple>
                @if(!empty($images))
                    <div class="d-flex flex-wrap mt-2">
                        @foreach(array_slice($images, 1) as $img)
                            <img src="{{ asset('storage/' . $img) }}" width="60" class="me-2 mb-2">
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6">
                <label>Deskripsi:</label>
                <input type="text" name="Description" value="{{ old('Description', $product->Description) }}" class="form-control">
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

        <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
        <a href="{{ route('products.index') }}" class="btn btn-dark">Kembali</a>
    </form>
</div>
@endsection
