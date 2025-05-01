<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div class="col-md-3 sidebar d-flex flex-column justify-content-between">
    <div>
        <div class="mb-5 d-flex align-items-center">
            <img src="/logo.png" alt="Logo" width="40" class="me-3">
            <strong class="fs-4">Gita Ulos</strong>
        </div>

        <div class="nav flex-column gap-3 fs-5">
            <a href="{{ route ('admin.homepage') }}" class="nav-link" id="product-link"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
            <a href="{{ route ('products.index') }}" class="nav-link" id="product-link"><i class="bi bi-box-seam me-2"></i>Produk</a>
            <a href="{{ route ('admin.reviews') }}" class="nav-link" id="review-link"><i class="bi bi-chat-left-dots me-2"></i>Ulasan</a>
            <a href="{{ route ('admin.orders') }}" class="nav-link" id="product-link"><i class="bi bi-tag me-2"></i>Pemesanan</a>
            <a href="{{ route ('homeAdmin') }}" class="nav-link" id="product-link"><i class="bi bi-house me-2"></i>Tampilan User</a>

            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="bi bi-clock-history me-2"></i>Riwayat</a>
                <ul class="dropdown-menu border-0 shadow bg-dark mt-1">
                    <li><a class="dropdown-item text-white" href="{{ route ('products.riwayat') }}"><i class="bi bi-box-arrow-in-right me-2"></i>Riwayat Produk</a></li>
                    <li><a class="dropdown-item text-white" href="{{ route ('admin.reviews.trashed') }}"><i class="bi bi-chat-left-text me-2"></i>Riwayat Ulasan</a></li>
                </ul>
            </div>
        </div>
    </div>

  
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarLinks = document.querySelectorAll('.sidebar .nav-link');

        sidebarLinks.forEach(link => {
            link.addEventListener('click', function() {
                sidebarLinks.forEach(link => link.classList.remove('active'));

                this.classList.add('active');
            });
        });
    });
</script>
