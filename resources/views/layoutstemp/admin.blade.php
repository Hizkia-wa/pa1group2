<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'Admin - Gita Ulos')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <style>
        :root {
            --primary-color: #ff7b54;
            --text-color: #f5f5f5;
            --bg-color: #121212;
            --sidebar-width: 240px;
        }

        body {
            background-color: #ffffff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Sidebar styling */
        .sidebar {
            background-color: var(--bg-color);
            color: var(--text-color);
            min-height: 100vh;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.15);
            padding: 1rem 0.75rem;
            width: var(--sidebar-width);
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            z-index: 1045;
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

        .nav-link:hover,
        .nav-link.active {
            background: rgba(255, 255, 255, 0.1);
            color: var(--primary-color);
        }

        .nav-link:hover::before,
        .nav-link.active::before {
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

        .nav-link:hover i,
        .nav-link.active i {
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

        /* Offcanvas overrides */
        .offcanvas-body {
            padding: 0;
        }

        .offcanvas .nav-menu {
            padding: 1rem;
        }

        /* Footer styling */
        .footer {
            background-color: #000000;
            padding: 1rem 0;
            margin-top: auto;
            border-top: 1px solid #333333;
            color: #ffffff;
            width: 100%;
            text-align: center;
        }

        .footer p {
            margin-bottom: 0;
        }

        /* Main content shift for sidebar desktop */
        @media (min-width: 768px) {
            .main-content {
                margin-left: var(--sidebar-width);
                padding: 2rem;
            }
        }

        /* On smaller screens, no margin for content */
        @media (max-width: 767.98px) {
            .main-content {
                padding: 1rem;
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <div class="container-fluid d-flex flex-column min-vh-100 p-0">
        
        {{-- Header with toggle on mobile --}}
        <header class="bg-light p-2 d-md-none">
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas">
                <i class="bi bi-list"></i> Menu
            </button>
        </header>

        <div class="row flex-grow-1 g-0">
            
            {{-- Sidebar for desktop --}}
            <div class="d-none d-md-block">
                <div class="sidebar">
                    @include('components.sidebar')
                </div>
            </div>

            {{-- Offcanvas sidebar for mobile --}}
            <div class="offcanvas offcanvas-start d-md-none" tabindex="-1" id="sidebarOffcanvas" aria-labelledby="sidebarOffcanvasLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="sidebarOffcanvasLabel">Gita Ulos</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    @include('components.sidebar')
                </div>
            </div>

            {{-- Main content --}}
            <main class="col p-3 main-content">
                @yield('content')
            </main>
        </div>

        {{-- Footer --}}
        <footer class="footer">
            <p>&copy; {{ date('Y') }} Gita Ulos. Hak Cipta Dilindungi.</p>
        </footer>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Active link highlight script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');

            navLinks.forEach(link => {
                const href = link.getAttribute('href');
                if (href && (currentPath.includes(href) || (href.includes('homepage') && currentPath === '/'))) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>
