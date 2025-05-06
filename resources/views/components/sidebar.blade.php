<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div class="col-md-3 sidebar">
    <div class="logo-container">
        <img src="{{ asset('img/ulos/logogita.png') }}" alt="Logo Gita Ulos" class="logo-img">
        <span class="logo-text">Gita Ulos</span>
    </div>
    
    <div class="nav-menu">
        <a href="{{ route ('admin.homepage') }}" class="nav-link" id="dashboard-link">
            <i class="bi bi-grid-1x2-fill"></i>
            <span>Dashboard</span>
        </a>
        
        <a href="{{ route ('products.index') }}" class="nav-link" id="product-link">
            <i class="bi bi-bag-fill"></i>
            <span>Produk</span>
        </a>
        
        <a href="{{ route ('admin.reviews') }}" class="nav-link" id="review-link">
            <i class="bi bi-star-fill"></i>
            <span>Ulasan</span>
        </a>
        
        <a href="{{ route ('admin.orders') }}" class="nav-link" id="order-link">
            <i class="bi bi-cart-check-fill"></i>
            <span>Pemesanan</span>
        </a>
        
        <a href="{{ route ('homeAdmin') }}" class="nav-link" id="user-view-link">
            <i class="bi bi-layout-text-window"></i>
            <span>Tampilan User</span>
        </a>
        
        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="history-link" data-bs-toggle="dropdown">
                <i class="bi bi-clock-history"></i>
                <span>Riwayat</span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" href="{{ route ('products.riwayat') }}">
                        <i class="bi bi-archive-fill me-2"></i>
                        <span>Riwayat Produk</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route ('admin.reviews.trashed') }}">
                        <i class="bi bi-chat-square-text-fill me-2"></i>
                        <span>Riwayat Ulasan</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>


<style>
    :root {
        --primary-color: #ff7b54;
        --text-color: #f5f5f5;
        --bg-color: #121212;
        --sidebar-width: 240px;
    }
    
    .sidebar {
        background-color: var(--bg-color);
        color: var(--text-color);
        min-height: 100vh;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.15);
        padding: 1rem 0.75rem;
    }
    
    .logo-container {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
        padding: 0.5rem;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.05);
        transition: all 0.2s ease;
    }
    
    .logo-img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .logo-text {
        font-size: 1.25rem;
        font-weight: 600;
        margin-left: 0.75rem;
        color: var(--text-color);
    }
    
    .nav-menu {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }
    
    .nav-link {
        display: flex;
        align-items: center;
        padding: 0.75rem 0.875rem;
        color: var(--text-color);
        border-radius: 6px;
        transition: all 0.2s ease;
        font-weight: 500;
        text-decoration: none;
        position: relative;
    }
    
    .nav-link::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 3px;
        background-color: var(--primary-color);
        opacity: 0;
        transition: opacity 0.2s;
    }
    
    .nav-link:hover, .nav-link.active {
        background: rgba(255, 255, 255, 0.1);
        color: var(--primary-color);
    }
    
    .nav-link:hover::before, .nav-link.active::before {
        opacity: 1;
    }
    
    .nav-link i {
        min-width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 6px;
        margin-right: 0.75rem;
        font-size: 1rem;
        transition: all 0.2s ease;
    }
    
    .nav-link:hover i, .nav-link.active i {
        background-color: var(--primary-color);
        color: var(--bg-color);
    }
    
    .dropdown-menu {
        background-color: #1a1a1a;
        border-radius: 6px;
        padding: 0.4rem;
        margin-top: 0.25rem;
        border: 1px solid rgba(255, 255, 255, 0.05);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        min-width: 180px;
    }
    
    .dropdown-item {
        color: var(--text-color);
        padding: 0.6rem 0.75rem;
        border-radius: 4px;
        transition: all 0.2s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
    }
    
    .dropdown-item:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: var(--primary-color);
    }
    
    .dropdown-toggle::after {
        margin-left: auto;
        vertical-align: middle;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set active link based on current page
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.sidebar .nav-link');
        
        navLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href && (currentPath.includes(href) || 
               (href.includes('homepage') && currentPath === '/'))) {
                link.classList.add('active');
            }
        });
    });
</script>