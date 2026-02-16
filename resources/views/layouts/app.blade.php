<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'RealEstate') }} - Find Your Dream Home</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.9) !important;
            transition: all 0.3s ease;
        }
        .navbar-brand {
            font-weight: 700;
            color: #0d6efd !important;
        }
        .btn-primary {
            padding: 0.6rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
        }
        .card {
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
        footer {
            background-color: #212529;
            color: #ced4da;
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <i class="bi bi-house-door-fill me-2"></i>
                <span>RealEstate</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold text-primary' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('properties.*') ? 'active fw-bold text-primary' : '' }}" href="{{ route('properties.index') }}">Properties</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    @auth
                        @php
                            $dashboardRoute = auth()->user()->isAdmin() ? 'admin.dashboard' : (auth()->user()->isAgent() ? 'agent.dashboard' : 'user.dashboard');
                        @endphp
                        <a href="{{ route($dashboardRoute) }}" class="btn btn-outline-primary me-2">Dashboard</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-link link-secondary text-decoration-none p-0">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-link link-dark text-decoration-none me-2">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="text-white fw-bold mb-3">RealEstate</h5>
                    <p>Connecting people with their dream homes since 2024. The most trusted platform for buying and renting properties.</p>
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="text-white fw-bold mb-3">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-decoration-none text-muted">Home</a></li>
                        <li><a href="{{ route('properties.index') }}" class="text-decoration-none text-muted">Properties</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h6 class="text-white fw-bold mb-3">Contact Us</h6>
                    <ul class="list-unstyled text-muted">
                        <li><i class="bi bi-geo-alt me-2"></i> 123 Real Estate Ave, NY</li>
                        <li><i class="bi bi-envelope me-2"></i> info@realestate.com</li>
                        <li><i class="bi bi-phone me-2"></i> +1 234 567 890</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6 class="text-white fw-bold mb-3">Follow Us</h6>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-muted fs-4"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-muted fs-4"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="text-muted fs-4"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4 border-secondary">
            <div class="text-center text-muted small">
                © {{ date('Y') }} RealEstate. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
