@extends('layouts.Admin')

@section('content')
<div class="container mt-4">
    <h2 class="page-title text-center">Pesanan Dibatalkan</h2>

    <div class="navbar-container">
        <div class="navbar-wrapper">
            <a href="{{ route('admin.orders') }}" 
               class="navbar-btn {{ request()->routeIs('admin.orders') && !request()->has('status') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart"></i> 
                Pesanan
            </a>
            <a href="{{ route('admin.orders.selesai', ['status' => 'Selesai']) }}" 
               class="navbar-btn navbar-btn-complete {{ request()->has('status') && request('status') == 'Selesai' ? 'active' : '' }}">
                <i class="fas fa-check-circle"></i> 
                Selesai
            </a>
            <a href="{{ route('admin.orders.batal', ['status' => 'Batal']) }}" 
               class="navbar-btn navbar-btn-cancel {{ request()->has('status') && request('status') == 'Batal' ? 'active' : '' }}">
                <i class="fas fa-times-circle"></i> 
                Cancel
            </a>
        </div>
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







<style>
:root {
    /* Color Palette */
    --color-primary: #3182ce;
    --color-secondary: #2d3748;
    --color-complete: #38a169;
    --color-cancel: #e53e3e;
    --color-text-light: #ffffff;
    --color-text-dark: #2d3748;
    --color-background: #f8f9fa;
}

/* Page Title */
.page-title {
    margin-bottom: 25px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--color-secondary);
    color: var(--color-text-dark);
    
}

/* Navbar Container */
.navbar-container {
    background-color: var(--color-background);
    border-radius: 12px;
    padding: 15px;
    margin-bottom: 25px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.navbar-wrapper {
    display: flex;
    gap: 15px;
    justify-content: flex-start;
    align-items: center;
}

/* Navbar Buttons */
.navbar-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 12px 20px;
    text-decoration: none;
    font-weight: 600;
    font-size: 15px;
    border-radius: 8px;
    color: var(--color-secondary);
    position: relative;
    transition: all 0.3s ease;
    background-color: transparent;
    border: 2px solid var(--color-secondary);
}

.navbar-btn i {
    margin-right: 10px;
    font-size: 16px;
}

/* Active State */
.navbar-btn.active {
    color: var(--color-text-light);
    border-color: transparent;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.navbar-btn.active::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 50%;
    transform: translateX(-50%);
    width: 80%;
    height: 4px;
    border-radius: 2px;
}

/* Default (Pesanan) Button */
.navbar-btn {
    background-color: transparent;
    border-color: var(--color-secondary);
    color: var(--color-secondary);
}

.navbar-btn.active,
.navbar-btn:hover {
    background-color: var(--color-primary);
    color: var(--color-text-light);
}

.navbar-btn.active::after {
    background-color: var(--color-text-light);
}

/* Complete Button */
.navbar-btn-complete {
    background-color: transparent;
    border-color: var(--color-complete);
    color: var(--color-complete);
}

.navbar-btn-complete.active,
.navbar-btn-complete:hover {
    background-color: var(--color-complete);
    color: var(--color-text-light);
}

.navbar-btn-complete.active::after {
    background-color: var(--color-text-light);
}

/* Cancel Button */
.navbar-btn-cancel {
    background-color: transparent;
    border-color: var(--color-cancel);
    color: var(--color-cancel);
}

.navbar-btn-cancel.active,
.navbar-btn-cancel:hover {
    background-color: var(--color-cancel);
    color: var(--color-text-light);
}

.navbar-btn-cancel.active::after {
    background-color: var(--color-text-light);
}

.table {
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    border-radius: 12px;
    overflow: hidden;
}

.table thead {
    background-color: var(--color-secondary);
    color: var(--color-text-light);
}
</style>











<script>
    document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.navbar-btn');
    
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            // Remove active class from all buttons
            buttons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
        });
    });
});
    // Add ripple effect to buttons
    const buttons = document.querySelectorAll('.nav-btn');
    
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            let x = e.clientX - e.target.getBoundingClientRect().left;
            let y = e.clientY - e.target.getBoundingClientRect().top;
            
            let ripple = document.createElement('span');
            ripple.className = 'ripple';
            ripple.style.left = `${x}px`;
            ripple.style.top = `${y}px`;
            
            this.appendChild(ripple);
            
            setTimeout(function() {
                ripple.remove();
            }, 600);
        });
    });
    </script>
@endsection
