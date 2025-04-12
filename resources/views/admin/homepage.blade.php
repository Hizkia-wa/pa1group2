@extends('layouts.Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="text-secondary">DASHBOARD</h5>
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <img src="https://i.pravatar.cc/30" alt="Admin" class="rounded-circle"> Admin
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Ubah Password</a></li>
                <li><a class="dropdown-item" href="#">Logout</a></li>
            </ul>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="dashboard-card">
                <h6>Jumlah Produk</h6>
                <h3>13</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card">
                <h6>Jumlah Kategori Produk</h6>
                <h3>4</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card">
                <h6>Jumlah Ulasan</h6>
                <h3>20</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card">
                <h6>Jumlah Produk Terlaris</h6>
                <h3>15</h3>
            </div>
        </div>
    </div>
@endsection
