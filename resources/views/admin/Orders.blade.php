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
                <th>Jumlah Pesan</th>
                <th>Ukuran</th>
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
                <td>{{ $order->Size }}</td>
                <td>
                    <a class="btn btn-warning">Detail</a>
                </td>
                <td>
                <div class="dropdown">
                    <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Konfirmasi
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="Diproses">
                                <button type="submit" class="dropdown-item text-primary fw-bold">Diproses</button>
                            </form>
                        </li>
                        <li>
                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="Selesai">
                                <button type="submit" class="dropdown-item text-success fw-bold">Selesai</button>
                            </form>
                        </li>
                        <li>
                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="Batal">
                                <button type="submit" class="dropdown-item text-danger fw-bold">Batal</button>
                            </form>
                        </li>
                    </ul>
                </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
