@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="text-center">Pesanan Dibatalkan</h2>

    <div class="text-center mb-3">
        <a href="{{ route('admin.orders') }}" class="btn btn-dark">Pesanan</a>
        <a href="{{ route('admin.orders.selesai') }}" class="btn btn-outline-dark">Selesai</a>
        <a href="{{ route('admin.orders.batal') }}" class="btn btn-dark">Cancel</a>
    </div>

    <table class="table table-bordered table-striped text-center">
        <thead class="bg-dark text-white">
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>No Telepon</th>
                <th>Alamat Email</th>
                <th>Jumlah Jenis</th>
                <th>Aksi Admin</th>
                <th>Status Pesanan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->CustomerName }}</td>
                    <td>{{ $order->Phone }}</td>
                    <td>{{ $order->Email }}</td>
                    <td>{{ $order->Quantity }} Jenis</td>
                    <td><a href="#" class="btn btn-warning">Detail</a></td>
                    <td><span class="btn btn-secondary text-danger fw-bold">Batal</span></td>
                </tr>
            @empty
                <tr><td colspan="7">Tidak ada pesanan dibatalkan</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
