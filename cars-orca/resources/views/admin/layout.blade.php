<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cars Orca - Admin Panel')</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --bg-dark: #0f172a;
            --sidebar-bg: #1e293b;
            --text-main: #f8fafc;
            --primary-glow: #6366f1;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-main);
            min-height: 100vh;
        }

        .sidebar {
            background-color: var(--sidebar-bg);
            min-height: 100vh;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }

        .nav-link {
            color: #94a3b8;
            border-radius: 8px;
            margin-bottom: 5px;
            transition: all 0.3s;
        }

        .nav-link:hover, .nav-link.active {
            background-color: rgba(99, 102, 241, 0.1);
            color: var(--text-main);
        }

        .nav-link i {
            width: 25px;
        }

        .admin-card {
            background-color: #1e293b;
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 12px;
        }

        .glow-text {
            background: linear-gradient(to right, #818cf8, #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .form-label {
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 500;
        }
        
        .text-muted, .form-label.text-muted, span.text-muted {
            color: #cbd5e1 !important;
        }

        ::placeholder {
            color: rgba(255, 255, 255, 0.5) !important;
            opacity: 1;
        }

        :-ms-input-placeholder {
            color: rgba(255, 255, 255, 0.5) !important;
        }

        ::-ms-input-placeholder {
            color: rgba(255, 255, 255, 0.5) !important;
        }
    </style>
    @yield('styles')
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar p-3 d-none d-md-block">
                <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center justify-content-center fw-bold fs-4 mb-4 text-decoration-none glow-text">
                    <img src="{{ asset('Logo.jpeg') }}" alt="Logo" class="rounded me-2" style="height: 35px; width: 35px; object-fit: cover;">
                    Admin Panel
                </a>
                <hr style="border-color: rgba(255,255,255,0.1)">
                <ul class="nav flex-column mt-3">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                            <i class="fa-solid fa-chart-pie me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.cars.index') }}" class="nav-link {{ Route::is('admin.cars.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-car me-2"></i> Manage Cars
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.enquiries.index') }}" class="nav-link {{ Route::is('admin.enquiries.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-envelope me-2"></i> Enquiries
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.sell-requests.index') }}" class="nav-link {{ Route::is('admin.sell-requests.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-hand-holding-dollar me-2"></i> Sell Requests
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.contacts.index') }}" class="nav-link {{ Route::is('admin.contacts.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-message me-2"></i> Contacts
                        </a>
                    </li>
                </ul>
                <hr style="border-color: rgba(255,255,255,0.1)">
                <a href="{{ route('home') }}" class="btn btn-outline-light btn-sm w-100 mb-2" target="_blank">
                    <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Visit Website
                </a>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                        <i class="fa-solid fa-right-from-bracket me-1"></i> Log Out
                    </button>
                </form>
            </div>

            <!-- Mobile Navbar Toggle -->
            <div class="col-12 d-md-none bg-dark p-3 border-bottom border-secondary">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fs-4 fw-bold glow-text">Cars Orca</span>
                    <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNav">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>
                <div class="collapse" id="mobileNav">
                    <ul class="nav flex-column mt-3">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.cars.index') }}" class="nav-link {{ Route::is('admin.cars.*') ? 'active' : '' }}">Manage Cars</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.enquiries.index') }}" class="nav-link {{ Route::is('admin.enquiries.*') ? 'active' : '' }}">Enquiries</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.sell-requests.index') }}" class="nav-link {{ Route::is('admin.sell-requests.*') ? 'active' : '' }}">Sell Requests</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.contacts.index') }}" class="nav-link {{ Route::is('admin.contacts.*') ? 'active' : '' }}">Contacts</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="col-md-9 col-lg-10 p-4">
                @if(session('success'))
                    <div class="alert alert-success bg-success text-white border-0 mb-4">
                        <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
