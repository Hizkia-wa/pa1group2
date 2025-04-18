@extends('layouts.Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="text-secondary">DASHBOARD</h5>
        <div class="dropdown admin-dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <img src="https://i.pravatar.cc/30" alt="Admin" class="rounded-circle"> Admin
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('admin.changePasswordForm') }}">Ubah Password</a>
                <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="dropdown-item">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <div class="dashboard-container">
        {{-- Card 1 --}}
        <div class="dashboard-card">
            <h6>Jumlah Produk</h6>
            <h3>13</h3>
        </div>

        {{-- Card 2 --}}
        <div class="dashboard-card">
            <h6>Jumlah Kategori Produk</h6>
            <h3>4</h3>
        </div>

        {{-- Card 3 --}}
        <div class="dashboard-card">
            <h6>Jumlah Ulasan</h6>
            <h3>20</h3>
        </div>

        {{-- Card 4 --}}
        <div class="dashboard-card">
            <h6>Jumlah Produk Terlaris</h6>
            <h3>15</h3>
        </div>
    </div>
@endsection
