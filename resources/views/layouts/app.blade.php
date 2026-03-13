<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'RealEstate') }} - Find Your Dream Home</title>
    <!-- Modern Font: Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #3730a3;
            --secondary: #a855f7;
            --gradient: linear-gradient(135deg, #4f46e5 0%, #a855f7 100%);
            --bg-light: #f8fafc;
            --card-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-light);
            color: #1e293b;
            overflow-x: hidden;
        }

        /* Navbar & Header */
        .navbar {
            backdrop-filter: blur(15px);
            background: rgba(255, 255, 255, 0.85);
            padding: 1.2rem 0;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            transition: var(--transition);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.6rem;
            letter-spacing: -1.2px;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-link {
            font-weight: 700;
            color: #475569 !important;
            padding: 0.5rem 1.2rem !important;
            transition: var(--transition);
        }

        .nav-link:hover {
            color: var(--primary) !important;
            transform: translateY(-1px);
        }

        /* Hero UI */
        .hero {
            background: var(--gradient);
            padding: 120px 0;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0; right: 0; bottom: 0; left: 0;
            background: url('https://www.transparenttextures.com/patterns/cubes.png');
            opacity: 0.1;
        }

        /* Card Improvements */
        .card {
            border: none;
            border-radius: 24px;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            overflow: hidden;
            background: #fff;
        }

        .card:hover {
            transform: translateY(-12px);
            box-shadow: 0 35px 50px -15px rgba(0, 0, 0, 0.12);
        }

        /* Modern Buttons */
        .btn-premium {
            background: var(--gradient);
            border: none;
            color: white;
            padding: 0.9rem 2.2rem;
            border-radius: 16px;
            font-weight: 700;
            transition: var(--transition);
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.2);
        }

        .btn-premium:hover {
            transform: scale(1.04) translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(79, 70, 229, 0.3);
            color: white;
        }

        .btn-white {
            background: #fff;
            color: var(--primary);
            border: none;
            padding: 0.9rem 2.2rem;
            border-radius: 16px;
            font-weight: 700;
            transition: var(--transition);
        }

        .btn-white:hover {
            background: #f1f5f9;
            transform: scale(1.04);
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
        }

        /* Badges & Widgets */
        .badge-soft {
            padding: 0.6rem 1.2rem;
            border-radius: 12px;
            font-weight: 800;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-primary-soft { background: rgba(79, 70, 229, 0.1); color: var(--primary); }

        /* Footer */
        footer {
            background: #0f172a;
            color: #94a3b8;
            padding: 80px 0 40px;
        }

        footer h4, footer h6 { color: #fff; }

        /* Global Classes */
        .text-gradient {
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .animate-up {
            animation: animateUp 0.7s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        @keyframes animateUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fw-800 { font-weight: 800; }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <i class="bi bi-houses-fill me-2 fs-3"></i> RealEstate
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list fs-1 text-primary"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('properties.index') }}">Browse Listings</a>
                    </li>
                    @guest
                        <li class="nav-item ms-lg-3">
                            <a class="nav-link" href="{{ route('login') }}">Sign In</a>
                        </li>
                        <li class="nav-item ms-lg-3">
                            <a class="btn btn-premium" href="{{ route('register') }}">Join Platform</a>
                        </li>
                    @else
                        <li class="nav-item ms-lg-4">
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center bg-light px-3 py-2 rounded-pill" href="#" data-bs-toggle="dropdown">
                                    <div class="text-end me-3 d-none d-sm-block">
                                        <div class="fw-800 small text-dark">{{ auth()->user()->name }}</div>
                                        <div class="text-muted" style="font-size: 0.7rem;">{{ ucfirst(auth()->user()->role) }}</div>
                                    </div>
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 40px; height: 40px; font-weight: 800;">
                                        {{ substr(auth()->user()->name, 0, 1) }}
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4 mt-3">
                                    <li><a class="dropdown-item py-2 px-3 fw-bold" href="{{ route(auth()->user()->role . '.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
                                    <li><a class="dropdown-item py-2 px-3 fw-bold" href="{{ route(auth()->user()->role . '.profile.index') }}"><i class="bi bi-person me-2"></i> Settings</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button class="dropdown-item py-2 px-3 text-danger fw-bold"><i class="bi bi-box-arrow-right me-2"></i> Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="mt-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5">
                    <h4 class="fw-800 mb-4">RealEstate Premium</h4>
                    <p class="opacity-75 lead" style="font-size: 1rem;">Experience the future of property browsing. We combine state-of-the-art technology with verified agents to help you find your sanctuary.</p>
                    <div class="d-flex gap-3 fs-3 mt-4">
                        <i class="bi bi-facebook text-white opacity-50"></i>
                        <i class="bi bi-twitter-x text-white opacity-50"></i>
                        <i class="bi bi-linkedin text-white opacity-50"></i>
                    </div>
                </div>
                <div class="col-6 col-lg-2 ms-lg-auto">
                    <h6 class="fw-800 mb-4">Marketplace</h6>
                    <ul class="list-unstyled">
                        <li class="mb-3"><a href="{{ route('properties.index') }}" class="text-reset text-decoration-none">Search Map</a></li>
                        <li class="mb-3"><a href="#" class="text-reset text-decoration-none">Verified Agents</a></li>
                        <li class="mb-3"><a href="#" class="text-reset text-decoration-none">Luxury Deals</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h6 class="fw-800 mb-4">Company</h6>
                    <ul class="list-unstyled">
                        <li class="mb-3"><a href="#" class="text-reset text-decoration-none">About Us</a></li>
                        <li class="mb-3"><a href="#" class="text-reset text-decoration-none">Careers</a></li>
                        <li class="mb-3"><a href="#" class="text-reset text-decoration-none">Legal & Privacy</a></li>
                    </ul>
                </div>
            </div>
            <hr class="my-5 opacity-25">
            <div class="d-flex justify-content-between align-items-center small opacity-50">
                <span>&copy; {{ date('Y') }} RealEstate Hub Inc.</span>
                <div class="d-flex gap-3">
                    <a href="#" class="text-white text-decoration-none">Terms</a>
                    <a href="#" class="text-white text-decoration-none">Privacy</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
