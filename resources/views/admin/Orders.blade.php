@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Daftar Pesanan</h2>

    <div class="nav-buttons-container">
        <a href="{{ route('admin.orders') }}" class="nav-btn {{ request()->routeIs('admin.orders') && !request()->has('status') ? 'active' : '' }}">
            <i class="fas fa-shopping-cart"></i> Pesanan
            @if(request()->routeIs('admin.orders') && !request()->has('status'))
                <span class="active-indicator"></span>
            @endif
        </a>
        <a href="{{ route('admin.orders.selesai', ['status' => 'Selesai']) }}" class="nav-btn complete-btn {{ request()->has('status') && request('status') == 'Selesai' ? 'active' : '' }}">
            <i class="fas fa-check-circle"></i> Selesai
            @if(request()->has('status') && request('status') == 'Selesai')
                <span class="active-indicator"></span>
            @endif
        </a>
        <a href="{{ route('admin.orders.batal', ['status' => 'Batal']) }}" class="nav-btn cancel-btn {{ request()->has('status') && request('status') == 'Batal' ? 'active' : '' }}">
            <i class="fas fa-times-circle"></i> Cancel
            @if(request()->has('status') && request('status') == 'Batal')
                <span class="active-indicator"></span>
            @endif
        </a>
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
 
    .nav-buttons-container {
        display: flex;
        gap: 15px;
        margin-bottom: 25px;
        padding: 5px;
        position: relative;
    }
    

    .nav-btn {
        background-color: #2d3748;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 15px;
        text-decoration: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 1;
    }
    
   
    .nav-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        color: white;
        text-decoration: none;
    }
    

    .nav-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, #4a5568, #2d3748);
        z-index: -1;
        transition: all 0.3s ease;
    }
    
    .nav-btn:hover::before {
        background: linear-gradient(45deg, #2d3748, #1a202c);
    }
    
    /* Active Button Style - ENHANCED */
    .nav-btn.active {
        background-color: transparent;
        color: white;
        box-shadow: 0 8px 15px rgba(66, 153, 225, 0.3);
        transform: translateY(-3px);
        text-decoration: none;
    }
    
    .nav-btn.active::before {
        background: linear-gradient(45deg, #3182ce, #4299e1);
    }
    
    /* Complete Button Style */
    .nav-btn.complete-btn::before {
        background: linear-gradient(45deg, rgba(66, 153, 225, 0.3), rgba(66, 153, 225, 0.3));
    }
    
    .nav-btn.complete-btn.active::before {
        background: linear-gradient(45deg,  rgba(66, 153, 225, 0.3), #2f855a);
    }
    

    .nav-btn.cancel-btn::before {
        background: linear-gradient(45deg, #c53030, #e53e3e);
    }
    
    .nav-btn.cancel-btn.active::before {
        background: linear-gradient(45deg, #9b2c2c, #c53030);
    }
    

    .nav-btn i {
        margin-right: 8px;
        font-size: 16px;
    }
    

    .nav-btn::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 3px;
        background-color: #fff;
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }
    
    .nav-btn.active::after {
        width: 80%;
    }
    

    .nav-btn.active .active-indicator {
        position: absolute;
        top: -8px;
        right: -8px;
        background-color: #fff;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        box-shadow: 0 0 8px rgba(255, 255, 255, 0.6);
        animation: pulse 1.5s infinite;
    }
</style>






<script>
   
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
