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

<style>
/* Base Layout Improvements */
body {
    background-color: #f5f7fa;
    font-family: 'Poppins', sans-serif;
}

/* Main Content Area */
.main-content-area {
    padding: 1.5rem 2rem;
}

/* Dashboard Title Bar with Modern Style */
.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.dashboard-title {
    position: relative;
    color: #333;
    font-size: 1.5rem;
    font-weight: 600;
    padding-left: 1rem;
    letter-spacing: 0.5px;
}

.dashboard-title::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 4px;
    background: #3a7bd5;
    border-radius: 5px;
}

/* Enhanced Dashboard Container */
.dashboard-container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.75rem;
    margin: 0 auto;
    max-width: 1300px;
}

/* Modern Card Design */
.dashboard-card {
    background: #ffffff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    position: relative;
    border: none;
}

.dashboard-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

/* Card Headers - Sleek Black with Color Accents */
.dashboard-card h6 {
    background-color: #000;
    color: white;
    font-size: 0.95rem;
    font-weight: 600;
    margin: 0;
    text-transform: uppercase;
    padding: 1rem;
    text-align: center;
    letter-spacing: 0.5px;
    position: relative;
}

/* Card Value Display */
.dashboard-card h3 {
    font-size: 3.5rem;
    font-weight: 700;
    color: #333;
    margin: 0;
    text-align: center;
    padding: 2rem 0;
    position: relative;
}

/* Card Value Icon Decoration */
.dashboard-card h3:before {
    content: '';
    position: absolute;
    width: 40px;
    height: 3px;
    bottom: 1.5rem;
    left: 50%;
    transform: translateX(-50%);
    background: #ddd;
    border-radius: 2px;
}

/* Individual Card Color Accents */
.dashboard-card:nth-child(1) h6:after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    height: 3px;
    width: 100%;
    background: #3a7bd5;
}

.dashboard-card:nth-child(2) h6:after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    height: 3px;
    width: 100%;
    background: #00c6ff;
}

.dashboard-card:nth-child(3) h6:after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    height: 3px;
    width: 100%;
    background: #f2994a;
}

.dashboard-card:nth-child(4) h6:after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    height: 3px;
    width: 100%;
    background: #6dd5ed;
}

/* Enhanced Sidebar */
.sidebar {
    background: #000;
    color: white;
    min-height: 100vh;
    padding-top: 1.5rem;
    position: sticky;
    top: 0;
}

.logo-container {
    display: flex;
    align-items: center;
    padding: 0 1.5rem 1.5rem;
    margin-bottom: 1.5rem;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.logo {
    width: 40px;
    height: 40px;
    margin-right: 0.75rem;
}

.logo-text {
    color: white;
    font-size: 1.5rem;
    font-weight: 600;
    margin: 0;
}

/* Sidebar Navigation */
.sidebar-nav {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar-nav a, .sidebar-nav button {
    color: rgba(255,255,255,0.7);
    text-decoration: none;
    display: flex;
    align-items: center;
    padding: 0.875rem 1.5rem;
    transition: all 0.3s;
    border-left: 3px solid transparent;
}

.sidebar-nav a:hover, .sidebar-nav button:hover,
.sidebar-nav a.active, .sidebar-nav button.active {
    background: rgba(255,255,255,0.05);
    color: white;
    border-left: 3px solid #3a7bd5;
}

.sidebar-nav .nav-icon {
    margin-right: 0.75rem;
    font-size: 1.25rem;
    width: 20px;
    text-align: center;
}

/* Admin Dropdown */
.admin-dropdown {
    position: relative;
}

.admin-dropdown .btn {
    display: flex;
    align-items: center;
    background: white;
    border: 1px solid #eaeaea;
    border-radius: 50px;
    padding: 0.5rem 1rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    transition: all 0.3s;
}

.admin-dropdown .btn:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.admin-dropdown img {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    margin-right: 0.5rem;
    border: 2px solid white;
    box-shadow: 0 0 0 2px #3a7bd5;
}

/* Mobile Responsiveness */
@media (max-width: 992px) {
    .dashboard-container {
        grid-template-columns: 1fr;
    }
}

/* Dashboard Blue Line Indicator */
.dashboard-indicator {
    position: relative;
    padding-left: 0.75rem;
}

.dashboard-indicator:before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 4px;
    background: #3a7bd5;
    border-radius: 2px;
}

/* Extra Subtle Animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.dashboard-card {
    animation: fadeIn 0.5s ease-out forwards;
}

.dashboard-card:nth-child(1) { animation-delay: 0.1s; }
.dashboard-card:nth-child(2) { animation-delay: 0.2s; }
.dashboard-card:nth-child(3) { animation-delay: 0.3s; }
.dashboard-card:nth-child(4) { animation-delay: 0.4s; }

/* Modern Scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
}

::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}
    </style>