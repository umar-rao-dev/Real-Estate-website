<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'RealEstate') }}</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #f8f9fa; }
        .navbar { backdrop-filter: blur(10px); background-color: rgba(255, 255, 255, 0.9) !important; }
        .navbar-brand { font-weight: 700; color: #0d6efd !important; }
        .btn-primary { border-radius: 8px; font-weight: 500; }
        footer { background-color: #212529; color: #ced4da; }
        .hero-section { background: linear-gradient(135deg, #0d6efd 0%, #003d99 100%); color: white; padding: 100px 0; }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <i class="bi bi-house-door-fill me-2"></i>
                <span>RealEstate</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active fw-bold text-primary' : '' }}" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('properties*') ? 'active fw-bold text-primary' : '' }}" href="{{ route('properties.index') }}">Properties</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('contact*') ? 'active fw-bold text-primary' : '' }}" href="{{ route('contact') }}">Contact Us</a>
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
        <div class="container text-center">
            <h5 class="text-white fw-bold mb-3">RealEstate</h5>
            <p>Connecting people with their dream homes. The most trusted platform for buying and renting properties.</p>
            <div class="d-flex justify-content-center gap-3 mb-4">
                <a href="#" class="text-muted fs-4"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-muted fs-4"><i class="bi bi-twitter-x"></i></a>
                <a href="#" class="text-muted fs-4"><i class="bi bi-instagram"></i></a>
            </div>
            <hr class="my-4 border-secondary">
            <div class="text-muted small">
                © {{ date('Y') }} RealEstate. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
