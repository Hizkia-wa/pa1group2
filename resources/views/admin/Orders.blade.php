@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Daftar Pesanan</h2>

    <div class="btn-group mb-3">
        <a href="{{ route('admin.orders') }}" class="btn btn-light border">Pesanan</a>
        <a href="{{ route('admin.orders.selesai', ['status' => 'Selesai']) }}" class="btn btn-dark">Selesai</a>
        <a href="{{ route('admin.orders.batal', ['status' => 'Batal']) }}" class="btn btn-dark">Cancel</a>
    </div>

    <table class="table table-bordered text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>No Telepon</th>
                <th>Alamat Email</th>
                <th>Alamat</th>
                <th>Jumlah Produk</th>
                <th>Aksi</th>
                <th>Status Pesanan</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($orders as $key => $group)
                @php
                    $first = $group->first();
                    $totalQty = $group->sum('Quantity');
                    [$name, $email, $phone, $date] = explode('|', $key);
                @endphp
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $name }}</td>
                    <td>{{ $phone }}</td>
                    <td>{{ $email }}</td>
                    <td>{{ $first->Address }}, {{ $first->District }}, {{ $first->City }}, {{ $first->PostalCode }}</td>
                    <td>{{ $totalQty }}</td>
                    <td>
                        <a href="#" class="btn btn-warning">Detail</a>
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Konfirmasi
                            </button>
                            <ul class="dropdown-menu">
                                @foreach ($group as $order)
                                    <li>
                                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="Diproses">
                                            <button type="submit" class="dropdown-item text-primary fw-bold">Diproses (ID {{ $order->id }})</button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
