@extends('layouts.admin')

@section('content')
<style>
    .product-section {
        padding: 40px 0;
        background-color: #f8f9fa;
    }

    .product-container {
        max-width: 1000px;
        margin: 0 auto;
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .product-left,
    .product-right {
        flex: 1 1 100%;
    }

    @media(min-width: 768px) {
        .product-left,
        .product-right {
            flex: 1 1 48%;
        }
    }

    .main-image {
        width: 100%;
        border-radius: 8px;
        margin-bottom: 15px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .thumbnails {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .thumbnail-img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #ccc;
        cursor: pointer;
    }

    .product-title {
        color: #dc3545;
        font-weight: bold;
        font-size: 1.8em;
    }

    .product-price {
        color: #212529;
        font-size: 1.5em;
        margin-bottom: 10px;
    }

    .btn {
        padding: 10px 16px;
        border-radius: 4px;
        font-weight: bold;
        text-decoration: none;
        display: inline-block;
        margin-right: 10px;
        cursor: pointer;
    }

    .btn-secondary {
        background-color: white;
        color: #6c757d;
        border: 1px solid #6c757d;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
        border: none;
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 999;
        left: 0;
        top: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0,0,0,0.8);
        justify-content: center;
        align-items: center;
    }

    .modal.open {
        display: flex;
    }

    .modal-content {
        position: relative;
        text-align: center;
        background-color: transparent;
        border: none;
        padding: 0;
    }

    .modal-image {
        max-width: 700px;
        max-height: 60vh;
        width: 100%;
        object-fit: contain;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.4);
    }

    .modal-close,
    .modal-prev,
    .modal-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: white;
        opacity: 0.7;
        border: none;
        padding: 10px;
        font-size: 24px;
        cursor: pointer;
        border-radius: 50%;
    }

    .modal-close {
        top: 10px;
        right: 10px;
        transform: none;
    }

    .modal-prev {
        left: 10px;
    }

    .modal-next {
        right: 10px;
    }
</style>

<div class="product-section">
    <div class="product-container">
        <!-- Kolom Gambar -->
        <div class="product-left">
            @php $images = json_decode($product->Images, true); @endphp
            @if (!empty($images))
                <img id="mainImage"
                     src="{{ asset('storage/' . $images[0]) }}"
                     class="main-image"
                     alt="Produk">

                <div class="thumbnails">
                    @foreach ($images as $img)
                        <img src="{{ asset('storage/' . $img) }}"
                             class="thumbnail-img"
                             data-img="{{ asset('storage/' . $img) }}"
                             alt="Thumbnail">
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Kolom Detail -->
        <div class="product-right">
            <h2 class="product-title">{{ $product->ProductName }}</h2>
            <h4 class="product-price">Rp {{ number_format($product->Price, 0, ',', '.') }}</h4>
            <p><strong>Kategori:</strong> {{ $product->Category }}</p>
            <p><strong>Deskripsi:</strong><br>{{ $product->Description }}</p>

            <div style="margin-top: 20px;">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-danger">Edit Produk</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Zoom Gambar -->
<div id="imageModal" class="modal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeModal()">&times;</button>
        <img id="modalImage" src="" class="modal-image" alt="Zoomed Image">
        <button id="prevBtn" class="modal-prev">&#10094;</button>
        <button id="nextBtn" class="modal-next">&#10095;</button>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const thumbnails = document.querySelectorAll('.thumbnail-img');
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        const imageSources = Array.from(thumbnails).map(img => img.getAttribute('data-img'));
        let currentIndex = 0;

        function showImage(index) {
            if (index >= 0 && index < imageSources.length) {
                modalImage.src = imageSources[index];
                currentIndex = index;
                modal.classList.add('open');
            }
        }

        thumbnails.forEach((thumbnail, index) => {
            thumbnail.addEventListener('click', () => {
                showImage(index);
            });
        });

        prevBtn.addEventListener('click', () => {
            let newIndex = currentIndex - 1;
            if (newIndex < 0) newIndex = imageSources.length - 1;
            showImage(newIndex);
        });

        nextBtn.addEventListener('click', () => {
            let newIndex = currentIndex + 1;
            if (newIndex >= imageSources.length) newIndex = 0;
            showImage(newIndex);
        });

        window.closeModal = function () {
            modal.classList.remove('open');
        };

        window.addEventListener('click', function (e) {
            if (e.target === modal) {
                closeModal();
            }
        });
    });
</script>
@endpush
