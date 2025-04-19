@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Pesanan selesai</h4>

    <div class="btn-group mb-3">
        <a href="{{ route('admin.orders') }}" class="btn btn-dark">Pesanan</a>
        <a href="{{ route('admin.orders.selesai') }}" class="btn btn-light border">Selesai</a>
        <a href="{{ route('admin.orders.batal', ['status' => 'Batal']) }}" class="btn btn-dark">Cancel</a>
    </div>

    <table class="table table-bordered text-center align-middle">
        <thead class="table-dark">
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
            @foreach ($orders as $index => $order)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $order->CustomerName }}</td>
                <td>{{ $order->Phone }}</td>
                <td>{{ $order->Email }}</td>
                <td>{{ $order->Quantity }}</td>
                <td>
                    <a href="{{ route('admin.orders', $order->id) }}" class="btn btn-warning">Detail</a>
                </td>
                <td>
                    <span class="btn btn-success disabled">Selesai</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection