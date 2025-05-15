@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="page-title">Daftar Pesanan</h2>

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
                        <a href="{{ route('admin.orders.detail', $first->id) }}" class="btn btn-warning">Detail</a>
                    </td>
                    <td>
    <div class="dropdown">
        <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown">
            Ubah Status
        </button>
        <ul class="dropdown-menu">
            @foreach ($group as $order)
                <li class="dropdown-header">Pesanan ID {{ $order->id }}</li>
                <li>
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="Diproses">
                        <button type="submit" class="dropdown-item text-primary">Diproses</button>
                    </form>
                </li>
                <li>
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="Selesai">
                        <button type="submit" class="dropdown-item text-success">Selesai</button>
                    </form>
                </li>
                <li>
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="Batal">
                        <button type="submit" class="dropdown-item text-danger">Batal</button>
                    </form>
                </li>
                <li><hr class="dropdown-divider"></li>
            @endforeach
        </ul>
    </div>
</td>
                </tr>
            @endforeach
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

/* Specific Button Colors */
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

/* Responsive Adjustments */
@media (max-width: 768px) {
    .navbar-wrapper {
        flex-direction: column;
        gap: 10px;
    }

    .navbar-btn {
        width: 100%;
        justify-content: center;
    }
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
