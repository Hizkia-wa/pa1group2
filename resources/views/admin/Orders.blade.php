@extends('layouts.admin') {{-- pastikan file layout admin sudah memuat sidebar admin --}}

@section('content')
<div class="container mt-4">
    {{-- Tombol status pesanan --}}
    <div class="mb-3">
        <button class="btn btn-dark me-2">Pesanan</button>
        <button class="btn btn-dark me-2">Selesai</button>
        <button class="btn btn-dark">Cancel</button>
    </div>

    {{-- Tabel pesanan --}}
    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>No. Telepon</th>
                    <th>Alamat Email</th>
                    <th>Jumlah</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                    <th>Status Pesanan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $index => $order)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $order->CustomerName }}</td>
                        <td>{{ $order->Phone }}</td>
                        <td>{{ $order->Email }}</td>
                        <td>{{ $order->Quantity }}</td>
                        <td>
                            {{ $order->Address }},
                            {{ $order->District }},
                            {{ $order->City }},
                            {{ $order->PostalCode }}
                        </td>
                        <td>
                            <a href="#" class="btn btn-warning">Detail</a>
                        </td>
                        <td>
                            <select class="form-select bg-warning text-dark">
                                <option value="Pesanan" {{ $order->OrderStatus == 'Pesanan' ? 'selected' : '' }}>Konfirmasi</option>
                                <option value="Selesai" {{ $order->OrderStatus == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="Cancel" {{ $order->OrderStatus == 'Cancel' ? 'selected' : '' }}>Cancel</option>
                            </select>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
