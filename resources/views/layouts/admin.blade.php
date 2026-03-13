<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'RealEstate') }} - Professional Panel</title>
    <!-- Modern Font: Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            --sidebar-bg: #0f172a;
            --main-bg: #f8fafc;
            --card-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.02);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--main-bg);
            color: #334155;
            overflow-x: hidden;
        }

        #wrapper {
            display: flex;
            width: 100%;
        }

        /* Sidebar Styling */
        #sidebar-wrapper {
            min-height: 100vh;
            width: 280px;
            background: var(--sidebar-bg);
            transition: var(--transition);
            position: fixed;
            z-index: 1000;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        }

        #page-content-wrapper {
            width: 100%;
            margin-left: 280px;
            transition: var(--transition);
        }

        .sidebar-heading {
            padding: 2.5rem 1.5rem;
            color: #fff;
            display: flex;
            align-items: center;
            font-weight: 800;
            font-size: 1.25rem;
            letter-spacing: -0.5px;
        }

        .list-group-item {
            background: transparent;
            border: none;
            color: #94a3b8;
            padding: 0.9rem 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            border-radius: 12px;
            margin: 0.3rem 1.2rem;
            transition: var(--transition);
        }

        .list-group-item:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
            transform: translateX(5px);
        }

        .list-group-item.active {
            background: var(--primary-gradient);
            color: #fff;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
        }

        .list-group-item i {
            font-size: 1.3rem;
            margin-right: 12px;
        }

        /* Navbar Styling */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            border-bottom: 1px solid #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        /* Card & Content UI */
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            background: #fff;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .btn-gradient {
            background: var(--primary-gradient);
            border: none;
            color: white;
            font-weight: 700;
            border-radius: 12px;
            padding: 0.7rem 1.8rem;
            transition: var(--transition);
        }

        .btn-gradient:hover {
            opacity: 0.95;
            transform: scale(1.02);
            color: white;
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
        }

        .btn-outline-custom {
            border: 2px solid #e2e8f0;
            background: #fff;
            color: #64748b;
            font-weight: 700;
            border-radius: 12px;
            padding: 0.7rem 1.5rem;
            transition: var(--transition);
        }

        .btn-outline-custom:hover {
            border-color: #6366f1;
            color: #6366f1;
            background: #f5f3ff;
        }

        .badge {
            padding: 0.6rem 1.2rem;
            border-radius: 10px;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        /* Responsive */
        @media (max-width: 992px) {
            #sidebar-wrapper { margin-left: -280px; }
            #sidebar-wrapper.toggled { margin-left: 0; }
            #page-content-wrapper { margin-left: 0; }
        }

        /* Typography Improvements */
        h1, h2, h3, h4, .fw-800 { font-weight: 800; }
        .text-muted { color: #64748b !important; }
        .small-caps { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; }
    </style>
    @yield('styles')
</head>
<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar-heading">
                <div class="bg-primary p-2 rounded-3 me-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="bi bi-houses-fill text-white fs-5"></i>
                </div>
                RealEstate
            </div>
            <div class="list-group list-group-flush mt-2">
                <div class="px-4 mb-2 small-caps text-secondary opacity-50">Main Menu</div>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="list-group-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2-fill"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.properties.index') }}" class="list-group-item {{ request()->routeIs('admin.properties.*') ? 'active' : '' }}">
                        <i class="bi bi-building"></i> Properties
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="list-group-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="bi bi-tags"></i> Categories
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="list-group-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i> Users
                    </a>
                    <a href="{{ route('admin.agent-requests.index') }}" class="list-group-item {{ request()->routeIs('admin.agent-requests.*') ? 'active' : '' }}">
                        <i class="bi bi-person-check"></i> Agent Requests
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="list-group-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                        <i class="bi bi-cart"></i> Store Orders
                    </a>
                @elseif(auth()->user()->isAgent())
                    <a href="{{ route('agent.dashboard') }}" class="list-group-item {{ request()->routeIs('agent.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                    <a href="{{ route('agent.properties.index') }}" class="list-group-item {{ request()->routeIs('agent.properties.*') ? 'active' : '' }}">
                        <i class="bi bi-house-add"></i> My Listings
                    </a>
                    <a href="{{ route('agent.orders.index') }}" class="list-group-item {{ request()->routeIs('agent.orders.*') ? 'active' : '' }}">
                        <i class="bi bi-cart-check"></i> Purchase Orders
                    </a>
                    <a href="{{ route('agent.queries.index') }}" class="list-group-item {{ request()->routeIs('agent.queries.*') ? 'active' : '' }}">
                        <i class="bi bi-envelope"></i> Queries
                    </a>
                @endif
                
                <div class="px-4 mt-4 mb-2 small-caps text-secondary opacity-50">Account</div>
                <a href="{{ auth()->user()->isAdmin() ? route('admin.profile.index') : route('agent.profile.index') }}" class="list-group-item">
                    <i class="bi bi-person-circle"></i> My Profile
                </a>
                <a href="{{ route('logout') }}" class="list-group-item text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-custom">
                <div class="container-fluid">
                    <button class="btn border-0 p-0 me-3" id="menu-toggle">
                        <i class="bi bi-list fs-3"></i>
                    </button>
                    
                    <div class="ms-auto d-flex align-items-center">
                        <!-- VIEW USER SIDE BUTTON -->
                        <a href="{{ route('home') }}" class="btn btn-outline-custom btn-sm me-4 d-none d-sm-inline-flex align-items-center">
                            <i class="bi bi-eye me-2"></i> View User Side
                        </a>

                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                                <div class="text-end me-3 d-none d-md-block">
                                    <div class="fw-bold small">{{ auth()->user()->name }}</div>
                                    <div class="text-muted extra-small" style="font-size: 0.7rem;">{{ ucfirst(auth()->user()->role) }}</div>
                                </div>
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 42px; height: 42px; font-weight: 800;">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4 mt-3">
                                <li><a class="dropdown-item py-2 px-3 fw-bold" href="{{ auth()->user()->isAdmin() ? route('admin.profile.index') : route('agent.profile.index') }}">Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item py-2 px-3 text-danger fw-bold" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign Out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="container-fluid px-4 py-5 fade-in">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("menu-toggle").addEventListener("click", function() {
            document.getElementById("sidebar-wrapper").classList.toggle("toggled");
        });
    </script>
    @yield('scripts')
</body>
</html>
