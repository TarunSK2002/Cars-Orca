<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cars Orca - Premium Used Cars')</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS (Ported Glassmorphism) -->
    <style>
        :root {
            --primary-glow: #6366f1;
            --secondary-glow: #a855f7;
            --accent-glow: #2dd4bf;
            --bg-dark: #0f172a;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
            --glass-blur: 20px;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-image: radial-gradient(circle at 10% 20%, rgba(99, 102, 241, 0.15) 0%, transparent 40%),
                              radial-gradient(circle at 90% 80%, rgba(168, 85, 247, 0.15) 0%, transparent 40%);
        }

        /* Glassmorphism Classes */
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(var(--glass-blur));
            -webkit-backdrop-filter: blur(var(--glass-blur));
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            color: var(--text-main);
        }

        .glass-nav {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--glass-border);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-link {
            color: var(--text-muted) !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--text-main) !important;
            text-shadow: 0 0 10px var(--primary-glow);
        }

        .premium-btn {
            background: linear-gradient(135deg, var(--primary-glow), var(--secondary-glow));
            border: none;
            color: white;
            padding: 10px 24px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        }

        .premium-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.6);
            color: white;
        }

        .glow-text {
            background: linear-gradient(to right, #818cf8, #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .text-muted, .form-label.text-muted, span.text-muted {
            color: #cbd5e1 !important;
        }

        .form-label {
            color: #f8fafc !important;
            font-weight: 500;
        }

        p {
            color: rgba(248, 250, 252, 0.8) !important;
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

        footer {
            background: rgba(15, 23, 42, 0.9);
            border-top: 1px solid var(--glass-border);
            margin-top: auto;
            padding: 20px 0;
        }

        /* Form Inputs */
        .glass-input {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            color: var(--text-main) !important;
            border-radius: 8px;
        }

        .glass-input:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--primary-glow);
            box-shadow: 0 0 10px rgba(99, 102, 241, 0.3);
        }

        /* Sold badge */
        .badge-sold {
            background-color: #ef4444;
            color: white;
            font-weight: 600;
        }

        .badge-available {
            background-color: #2dd4bf;
            color: #0f172a;
            font-weight: 600;
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg glass-nav navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3 glow-text d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ asset('Logo.jpeg') }}" alt="Logo" class="rounded me-2" style="height: 40px; width: 40px; object-fit: cover;">
                Cars Orca
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('shop') ? 'active' : '' }}" href="{{ route('shop') }}">Buy Cars</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('sell') ? 'active' : '' }}" href="{{ route('sell') }}">Sell Your Car</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('about') ? 'active' : '' }}" href="{{ route('about') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="nav-link {{ Route::is('wishlist.index') ? 'active' : '' }}" href="{{ route('wishlist.index') }}">
                            <i class="fa-solid fa-heart text-danger fs-5"></i> Wishlist
                        </a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-info rounded-pill px-3 py-1">
                            <i class="fa-solid fa-user-gear me-1"></i> Admin Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container my-5">
        @if(session('success'))
            <div class="alert alert-success glass-card mb-4 border-0 text-white" style="background: rgba(45, 212, 191, 0.2);">
                <i class="fa-solid fa-circle-check me-2" style="color: var(--accent-glow);"></i> {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p class="mb-1">&copy; {{ date('Y') }} <span class="glow-text fw-bold">Cars Orca</span>. All rights reserved.</p>
            <p class="small text-muted mb-0">Financial Advisor: <a href="https://tideorca.com" target="_blank" class="text-decoration-none text-info">tideorca.com</a></p>
            <p class="small text-muted mt-2 mb-0">Designed & Maintained by <a href="https://tarun.tideorca.com/" target="_blank" class="text-decoration-none text-info">Tarun SK</a></p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
