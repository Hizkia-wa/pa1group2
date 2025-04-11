@extends('layouts.admin')

@section('title', 'Riwayat Produk')

@section('content')
<div class="container">
    <h2 class="text-center mt-3 mb-4">Riwayat Produk yang Dihapus</h2>

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-success">
                <tr>
                    <th>No.</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Gambar Utama</th>
                    <th>Slide Carousel 1</th>
                    <th>Slide Carousel 2</th>
                    <th>Slide Carousel 3</th>
                    <th>Aksi Admin</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $index => $product)
                    @php
                        $images = json_decode($product->Images, true);
                        $mainImage = $images['main'] ?? null;
                        $carousel = $images['carousel'] ?? [];
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product->ProductName }}</td>
                        <td>{{ $product->Category }}</td>
                        <td>Rp{{ number_format($product->Price, 0, ',', '.') }}</td>
                        <td>{{ $product->Description }}</td>
                        <td>{{ $mainImage ? basename($mainImage) : '-' }}</td>
                        <td>{{ isset($carousel[0]) ? basename($carousel[0]) : '-' }}</td>
                        <td>{{ isset($carousel[1]) ? basename($carousel[1]) : '-' }}</td>
                        <td>{{ isset($carousel[2]) ? basename($carousel[2]) : '-' }}</td>
                        <td>
                            <form action="{{ route('riwayat.restore', $product->ProductID) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Pulihkan</button>
                            </form>
                            <form action="{{ route('riwayat.delete', $product->ProductID) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus permanen?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10">Tidak ada produk dalam riwayat.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
