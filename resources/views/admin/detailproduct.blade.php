@extends('layouts.Admin')

@section('content')
<div style="background-color:#f8f9fa; padding:40px;">
    <div style="max-width:1000px; margin:auto; background:#fff; padding:30px; border-radius:16px; box-shadow:0 10px 30px rgba(0,0,0,0.1);">
        <div style="display:flex; flex-wrap:wrap; gap:30px;">
            <!-- Gambar -->
            <div style="flex:1;">
                @php $images = json_decode($product->Images, true); @endphp
                @if (!empty($images))
                    <!-- Gambar utama -->
                    <img id="mainImage" src="{{ asset('storage/' . $images[0]) }}" style="width:100%; border-radius:12px; box-shadow:0 4px 10px rgba(0,0,0,0.2);" alt="Produk">

                    <!-- Thumbnail -->
                    <div style="display:flex; gap:10px; margin-top:10px; flex-wrap:wrap;">
                        @foreach ($images as $img)
                            <img src="{{ asset('storage/' . $img) }}"
                                 class="thumbnail-img"
                                 style="width:80px; height:80px; border-radius:8px; object-fit:cover; border:2px solid #ccc; cursor:pointer;"
                                 data-bs-toggle="modal"
                                 data-bs-target="#imageModal"
                                 data-img="{{ asset('storage/' . $img) }}"
                                 alt="Thumbnail">
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Detail Produk -->
            <div style="flex:1; display:flex; flex-direction:column; justify-content:space-between;">
                <div>
                    <h2 style="color:#b30000; font-weight:bold;">{{ $product->ProductName }}</h2>
                    <h4 style="color:#333;">Rp {{ number_format($product->Price, 0, ',', '.') }}</h4>
                    <p><strong>Kategori:</strong> {{ $product->Category }}</p>
                    <p><strong>Deskripsi:</strong><br>{{ $product->Description }}</p>
                </div>
                <div style="margin-top:20px;">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Kembali</a>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn" style="background:#b30000; color:white; margin-left:10px;">Edit Produk</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Gambar -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 90vw; width: 90%; max-height: 90vh;">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body text-center">
                <!-- Tombol tutup (X) -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position:absolute; top:10px; right:10px; z-index:1050; background-color: transparent; border: none;">
                    <span aria-hidden="true" style="color:white; font-size: 30px;">&times;</span>
                </button>
                <!-- Gambar zoomed -->
    <img id="modalImage" src="{{ asset('storage/' . $images[0]) }}" class="img-fluid rounded shadow" alt="Zoomed Image" style="width: 100%; height: auto; max-height: 80vh; object-fit: contain;">

    <!-- Tombol navigasi -->
    <button id="prevBtn" class="btn btn-light position-absolute top-50 start-0 translate-middle-y" style="z-index:1050; opacity:0.7;">&#10094;</button>
    <button id="nextBtn" class="btn btn-light position-absolute top-50 end-0 translate-middle-y" style="z-index:1050; opacity:0.7;">&#10095;</button>
</div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const thumbnails = document.querySelectorAll('.thumbnail-img');
        const modalImage = document.getElementById('modalImage');

        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function () {
                const imgSrc = this.getAttribute('data-img');
                modalImage.src = imgSrc;
            });
        });
    });
</script>
@endsection
