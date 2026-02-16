@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Dashboard Hero Section -->
    <div class="dashboard-hero">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="fw-bold mb-2">Welcome Back, {{ auth()->user()->name }}!</h2>
                <p class="lead mb-0 opacity-75">You have full control over the platform. Manage users, properties, and requests with ease.</p>
            </div>
            <div class="col-md-4 text-md-end d-none d-md-block">
                <div class="display-4 fw-bold mb-0">{{ $totalProperties }}</div>
                <div class="text-uppercase small opacity-75">Active Listings</div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <!-- Total Users -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase mb-2">Total Users</h6>
                            <h2 class="mb-0">{{ $totalUsers }}</h2>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                            <i class="bi bi-people fs-1 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Agents -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase mb-2">Total Agents</h6>
                            <h2 class="mb-0">{{ $totalAgents }}</h2>
                        </div>
                        <div class="bg-success bg-opacity-10 p-3 rounded">
                            <i class="bi bi-person-badge fs-1 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Properties -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase mb-2">Total Properties</h6>
                            <h2 class="mb-0">{{ $totalProperties }}</h2>
                        </div>
                        <div class="bg-info bg-opacity-10 p-3 rounded">
                            <i class="bi bi-building fs-1 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Categories -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase mb-2">Categories</h6>
                            <h2 class="mb-0">{{ \App\Models\Category::count() }}</h2>
                        </div>
                        <div class="bg-warning bg-opacity-10 p-3 rounded">
                            <i class="bi bi-grid fs-1 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Properties -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Latest Properties</h5>
                        <a href="{{ route('admin.properties.index') }}" class="btn btn-sm btn-primary">
                            View All <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($latestProperties->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Agent</th>
                                        <th>Price</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($latestProperties as $property)
                                    <tr>
                                        <td>{{ $property->id }}</td>
                                        <td>
                                            <strong>{{ $property->title }}</strong><br>
                                            <small class="text-muted">
                                                <i class="bi bi-geo-alt"></i> {{ $property->location }}
                                            </small>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $property->category->name }}</span>
                                        </td>
                                        <td>{{ $property->user->name }}</td>
                                        <td>
                                            <strong class="text-success">${{ number_format($property->price, 2) }}</strong>
                                        </td>
                                        <td>
                                            <span class="badge {{ $property->type == 'buy' ? 'bg-primary' : 'bg-info' }}">
                                                {{ ucfirst($property->type) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge {{ $property->availability == 'available' ? 'bg-success' : 'bg-danger' }}">
                                                {{ ucfirst($property->availability) }}
                                            </span>
                                        </td>
                                        <td>{{ $property->created_at->format('M d, Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-inbox fs-1 text-muted"></i>
                            <p class="text-muted mt-2">No properties found</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
