@extends('layouts.customer')

@section('content')
<style>
    .container {
        max-width: 1200px;
        margin: 40px auto;
        display: flex;
        gap: 40px;
        flex-wrap: wrap;
    }

    .product-detail {
        flex: 1;
        background-color: #e0f7fa;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .product-detail img.main-image {
        width: 100%;
        max-height: 300px;
        object-fit: cover;
        border-radius: 8px;
    }

    .product-detail .thumbnail-group {
        display: flex;
        gap: 10px;
        margin-top: 10px;
        flex-wrap: wrap;
    }

    .product-detail .thumbnail-group img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    .order-form {
        flex: 1;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid #ccc;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .order-form h5 {
        margin-bottom: 20px;
        color: #007bff;
    }

    .order-form .form-group {
        margin-bottom: 15px;
    }

    .order-form label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .order-form input[type="text"],
    .order-form input[type="email"],
    .order-form input[type="number"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .order-form .size-options {
        display: flex;
        gap: 10px;
    }

    .order-form .size-options label {
        padding: 8px 12px;
        border: 1px solid #007bff;
        border-radius: 5px;
        cursor: pointer;
    }

    .order-form .size-options input[type="radio"] {
        display: none;
    }

    .order-form .size-options input[type="radio"]:checked + label {
        background-color: #007bff;
        color: white;
    }

    .btn-submit {
        background-color: #25d366;
        color: white;
        border: none;
        padding: 12px;
        font-weight: bold;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        margin-top: 20px;
    }

    .product-meta {
        margin-top: 15px;
        font-size: 0.9rem;
        color: #666;
    }

    .product-meta div {
        margin-bottom: 5px;
    }
</style>

<div class="container">
    <!-- Detail Produk -->
    <div class="product-detail">
        <img src="{{ $product->all_images[0] ?? asset('images/no-image.png') }}" class="main-image" alt="Foto Produk">
        <div class="thumbnail-group">
            @foreach ($product->all_images as $image)
                <img src="{{ $image }}" alt="Gambar Tambahan">
            @endforeach
        </div>

        <h3 class="mt-3">{{ $product->ProductName }}</h3>
        <p style="color: red; font-size: 1.2rem;">Rp {{ number_format($product->Price, 0, ',', '.') }}</p>
        <p><strong>Stok:</strong> <span id="product-stock">{{ $product->Quantity }}</span></p>

        <h4>Deskripsi Produk</h4>
        <p>{{ $product->Description }}</p>
    </div>

    <!-- Form Pemesanan -->
    <div class="order-form">
        <form id="orderForm" method="POST">
            @csrf
            <input type="hidden" name="ProductId" value="{{ $product->id }}">

            <h5>Form Pemesanan</h5>

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Telepon</label>
                <input type="text" name="phone" required>
            </div>

            <div class="form-group">
                <label>Kabupaten/Kota</label>
                <input type="text" name="city" required>
            </div>

            <div class="form-group">
                <label>Kecamatan</label>
                <input type="text" name="district" required>
            </div>

            <div class="form-group">
                <label>Jalan</label>
                <input type="text" name="address" required>
            </div>

            <div class="form-group">
                <label>Kode Pos</label>
                <input type="text" name="postal_code" required>
            </div>

            <div class="form-group">
                <label>Jumlah</label>
                <input type="number" name="Quantity" value="1" min="1" required>
            </div>

            <button type="button" class="btn-submit" id="waButton" data-admin="6282274398996">
                <i class="bi bi-whatsapp me-2"></i>Pesan Melalui WhatsApp
            </button>

            <div class="product-meta">
                <div>SKU: REUH-4234-UU</div>
                <div>Kategori: {{ $product->Category }}</div>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('waButton').addEventListener('click', function () {
    const form = document.getElementById('orderForm');
    const formData = {
        _token: '{{ csrf_token() }}',
        ProductId: '{{ $product->id }}',
        name: form.name.value,
        email: form.email.value,
        phone: form.phone.value,
        city: form.city.value,
        district: form.district.value,
        address: form.address.value,
        postal_code: form.postal_code.value,
        Quantity: form.Quantity.value
    };

    fetch("{{ route('customer.product.order') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": formData._token
        },
        body: JSON.stringify(formData)
    })
    .then(response => {
        if (!response.ok) throw new Error("Gagal kirim data");
        return response.json();
    })
    .then(data => {
        if (data.success) {
            const order = data.order;
            document.getElementById('product-stock').innerText = data.newStock;
            form.reset();
            const message = `Halo Admin, saya ingin memesan produk:

📦 *{{ $product->ProductName }}*
📁 Kategori: {{ $product->Category }}
💵 Harga: Rp {{ number_format($product->Price, 0, ',', '.') }}

👤 Nama: ${formData.name}
📱 Telepon: ${formData.phone}
📧 Email: ${formData.email}
🏠 Alamat: ${formData.address}, ${formData.district}, ${formData.city}, ${formData.postal_code}
🔢 Jumlah: ${formData.Quantity}

Mohon segera diproses ya 🙏`;

            const nomorAdmin = document.getElementById('waButton').dataset.admin;
            const waLink = `https://wa.me/${nomorAdmin}?text=${encodeURIComponent(message)}`;
            window.open(waLink, '_blank');
        } else {
            alert("Terjadi kesalahan, coba lagi.");
        }
    })
    .catch(err => {
        alert("Terjadi kesalahan saat mengirim pesanan. Silakan coba lagi.");
        console.error(err);
    });
});

</script>

@endsection
