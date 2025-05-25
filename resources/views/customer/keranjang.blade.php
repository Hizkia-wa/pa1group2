@extends('layouts.customer')

@section('content')
<div class="container mt-5 d-flex">
    {{-- Daftar Produk di Keranjang --}}
    <div class="w-50 me-4">
        <h3 class="mb-4 fw-bold">Keranjang</h3>

        @foreach ($cartWithProduct as $item)
        @php
            $product = $item->product;
            $images = json_decode($product->Images, true);
            $imagePath = isset($images[0]) ? asset('storage/app/public/' . $images[0]) : asset('images/default.png');
        @endphp

        <div class="card mb-3 p-3 d-flex flex-row align-items-center" style="border: 1px solid #ddd; border-radius: 10px;">
            
            <!-- Checkbox -->
            <div class="form-check me-3">
                <input 
                    type="checkbox" 
                    name="selected[]" 
                    value="{{ $item->id }}" 
                    class="form-check-input cart-checkbox"
                >
            </div>

            <!-- Gambar Produk -->
            <div style="width: 100px; height: 100px; overflow: hidden;" class="me-3">
                <img src="{{ $imagePath }}" alt="{{ $product->ProductName }}" class="w-100 h-100 object-fit-cover">
            </div>

            <!-- Detail Produk -->
            <div class="flex-grow-1">
                <h5 class="fw-bold mb-1">{{ $product->ProductName }}</h5>
                <div class="text-danger fw-bold mb-1">Rp.{{ number_format($product->Price, 0, ',', '.') }}</div>

                <!-- Kontrol Jumlah -->
                <form action="{{ route('user.cart.update', $item->id) }}" method="POST" class="d-flex align-items-center">
                    @csrf
                    @method('PUT')
                    <button type="submit" name="action" value="decrease" class="btn btn-outline-secondary btn-sm me-2">−</button>
                    <span class="fw-bold quantity-value">{{ $item->Quantity }}</span>
                    <input type="hidden" name="quantity" value="{{ $item->Quantity }}">
                    <button type="submit" name="action" value="increase" class="btn btn-outline-secondary btn-sm ms-2">+</button>
                </form>
            </div>

            <!-- Hapus -->
            <form action="{{ route('user.cart.remove', $item->id) }}" method="POST" class="ms-3">
                @csrf
                <button class="btn btn-outline-danger btn-sm">Hapus</button>
            </form>
        </div>
        @endforeach
    </div>

    {{-- Form Pemesanan --}}
    <div class="w-50">
        <h4 class="fw-bold mb-4">Form Pemesanan</h4>
        <form action="{{ route('user.cart.checkout') }}" method="POST" id="checkoutForm">
            @csrf
            <h6 class="fw-bold">Informasi Pembeli</h6>
            <div class="mb-2">
                <input type="text" name="CustomerName" class="form-control" placeholder="Nama" required>
            </div>
            <div class="mb-2">
                <input type="email" name="Email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="text" name="Phone" class="form-control" placeholder="Telepon" required>
            </div>

            <h6 class="fw-bold">Informasi Pengiriman</h6>
            <div class="mb-2">
                <input type="text" name="City" class="form-control" placeholder="Kabupaten/Kota" required>
            </div>
            <div class="mb-2">
                <input type="text" name="District" class="form-control" placeholder="Kecamatan" required>
            </div>
            <div class="mb-2">
                <input type="text" name="Street" class="form-control" placeholder="Jalan" required>
            </div>
            <div class="mb-3">
                <input type="text" name="PostalCode" class="form-control" placeholder="Kode Pos" required>
            </div>

            <h6 class="fw-bold">Informasi Pemesanan</h6>
            <div class="mb-3">
                <label>Jumlah :</label>
                <input type="number" id="totalQuantity" name="totalQuantity" class="form-control w-25" readonly value="0">
            </div>

            {{-- Checkbox tersembunyi yang diisi via JS saat submit --}}
            <div id="selectedItemsWrapper"></div>

            <button type="button" class="btn btn-success w-100 mb-3" id="waButton" data-admin="6282274398996">
                <i class="bi bi-whatsapp"></i> Pesan Melalui WA
            </button>

            <small class="d-block text-muted">
                SKU: RELH-423-UU <br>
                Kategori: Ulos
            </small>
        </form>
    </div>
</div>

<script>
    function updateQuantity() {
        let total = 0;
        const checkboxes = document.querySelectorAll('.cart-checkbox');
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const qty = parseInt(checkbox.closest('.card').querySelector('.quantity-value').innerText);
                total += qty;
            }
        });
    }

    document.querySelectorAll('.cart-checkbox').forEach(cb => {
        cb.addEventListener('change', updateQuantity);
    });

    document.getElementById('checkoutForm').addEventListener('submit', function (e) {
        prepareSelectedItems();
    });

    document.getElementById('waButton').addEventListener('click', function () {
        const form = document.getElementById('checkoutForm');
        const selected = document.querySelectorAll('.cart-checkbox:checked');

        if (selected.length === 0) {
            alert('Pilih minimal 1 produk untuk checkout.');
            return;
        }

        prepareSelectedItems(); // siapkan selected[] di form

        const formData = new FormData(form);

        fetch("{{ route('user.cart.checkout') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) throw new Error("Gagal mengirim data.");
            return response.json();
        })
        .then(data => {
            if (data.success) {
                const message = `Halo Admin, saya ingin memesan produk:

🛒 *Keranjang Belanja*:
${data.products.map(item => `- ${item.name} x${item.quantity}`).join('\n')}

💵 *Total Harga*: Rp ${data.totalPrice.toLocaleString('id-ID')}

👤 *Nama*: ${formData.get('CustomerName')}
📱 *Telepon*: ${formData.get('Phone')}
📧 *Email*: ${formData.get('Email')}
🏠 *Alamat*: ${formData.get('Street')}, ${formData.get('District')}, ${formData.get('City')} - ${formData.get('PostalCode')}
🔢 *Jumlah*: ${formData.get('totalQuantity')}

Mohon segera diproses ya 🙏`;

                const nomorAdmin = document.getElementById('waButton').dataset.admin;
                const waLink = `https://wa.me/${nomorAdmin}?text=${encodeURIComponent(message)}`;
                window.open(waLink, '_blank');
            } else {
                alert('Gagal checkout. Coba lagi.');
            }
        })
        .catch(error => {
            console.error(error);
            alert('Terjadi kesalahan saat memproses checkout.');
        });
    });
</script>

@endsection
