@extends('layouts.Admin') {{-- Sesuaikan dengan layout utama kamu --}}

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Gambar utama -->
        <div class="col-md-6">
            @php
                $images = json_decode($product->Images, true);
            @endphp

            @if (!empty($images))
                <!-- Gambar utama (dapat diklik untuk membuka modal) -->
                <img src="{{ asset('storage/' . $images[0]) }}" width="250" class="img-thumbnail shadow-sm mb-3" data-bs-toggle="modal" data-bs-target="#imageModal" alt="Gambar Produk">

                <!-- Gambar lainnya (dapat diklik untuk membuka modal) -->
                <div class="d-flex gap-2 mt-3">
                    @foreach (array_slice($images, 1) as $img)
                        <img src="{{ asset('storage/' . $img) }}" class="rounded border shadow-sm" width="90" height="90" alt="Additional Image" data-bs-toggle="modal" data-bs-target="#imageModal">
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Detail produk -->
        <div class="col-md-6">
            <h3 class="fw-bold text-primary">{{ $product->ProductName }}</h3>
            <h5 class="text-muted mb-3">Rp {{ number_format($product->Price, 0, ',', '.') }}</h5>

            <p><strong>Kategori:</strong> {{ $product->Category }}</p>

            <p><strong>Deskripsi:</strong></p>
            <p>{{ $product->Description }}</p>

            <div class="mt-4">
                <a href="{{ route('products.index') }}" class="btn btn-outline-primary">Kembali</a>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit Produk</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk gambar -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid shadow" alt="Full Image">
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Menangani klik gambar untuk menampilkan gambar besar di modal
    const images = document.querySelectorAll('img[data-bs-toggle="modal"]');
    images.forEach(image => {
        image.addEventListener('click', function() {
            const src = this.src;
            document.getElementById('modalImage').src = src;
        });
    });
</script>
@endsection
