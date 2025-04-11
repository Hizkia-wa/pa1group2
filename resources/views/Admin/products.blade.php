@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 d-md-block bg-success sidebar vh-100">
            <div class="position-sticky">
                <ul class="nav flex-column mt-4">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white active bg-dark" href="{{ route('admin.products') }}">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.reviews') }}">Ulasan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.website') }}">Halaman Website</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-white dropdown-toggle" href="#" id="riwayatDropdown" role="button" data-bs-toggle="dropdown">
                            Riwayat ▼
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.riwayat.produk') }}">Riwayat Produk</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.riwayat.ulasan') }}">Riwayat Ulasan</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Konten utama -->
        <main class="col-md-10 ms-sm-auto px-4">
            <div class="d-flex justify-content-between mt-4">
                <input type="text" class="form-control w-50" placeholder="Cari...">
                <a href="{{ route('admin.products.create') }}" class="btn btn-success ms-3">Tambah Produk</a>
            </div>

            <table class="table table-bordered table-hover mt-4">
                <thead class="table-success text-center">
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Gambar Utama</th>
                        <th>Slide 1</th>
                        <th>Slide 2</th>
                        <th>Slide 3</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $index => $product)
                        @php
                            $images = json_decode($product->images, true);
                            $carousel = $images['carousel'] ?? [];
                        @endphp
                        <tr class="text-center align-middle">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->category }}</td>
                            <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>{{ Str::limit($product->description, 50) }}</td>
                            <td>
                                @if(!empty($images['main']))
                                    <img src="{{ asset('storage/' . $images['main']) }}" width="50">
                                @else
                                    <span class="text-danger">-</span>
                                @endif
                            </td>
                            @for($i = 0; $i < 3; $i++)
                                <td>
                                    @if(!empty($carousel[$i]))
                                        <img src="{{ asset('storage/' . $carousel[$i]) }}" width="50">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            @endfor
                            <td>
                                <a href="{{ route('admin.products.view', $product->id) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </main>
    </div>
</div>
@endsection
