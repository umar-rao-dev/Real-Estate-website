@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Dashboard Hero Section -->
    <div class="dashboard-hero bg-success" style="background: linear-gradient(135deg, #198754 0%, #0c4d2d 100%);">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="fw-bold mb-2">Hello, Agent {{ auth()->user()->name }}!</h2>
                <p class="lead mb-0 opacity-75">Your listings are performing great today. You have {{ $totalQueries }} new potential queries.</p>
            </div>
            <div class="col-md-4 text-md-end d-none d-md-block">
                <i class="bi bi-patch-check-fill" style="font-size: 5rem; opacity: 0.2;"></i>
            </div>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="row mb-4">
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center p-4">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 me-3">
                        <i class="bi bi-building fs-2"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">My Properties</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalProperties }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center p-4">
                    <div class="bg-success bg-opacity-10 text-success rounded-circle p-3 me-3">
                        <i class="bi bi-envelope-paper fs-2"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Total Queries</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalQueries }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Properties -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0">My Latest Properties</h5>
            <a href="{{ route('agent.properties.index') }}" class="btn btn-sm btn-link text-decoration-none p-0">View All</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Property</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Approval</th>
                            <th class="text-end pe-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestProperties as $property)
                        <tr>
                            <td class="ps-4">
                                <strong>{{ $property->title }}</strong><br>
                                <small class="text-muted"><i class="bi bi-geo-alt"></i> {{ $property->location }}</small>
                            </td>
                            <td><span class="badge bg-secondary">{{ $property->category->name }}</span></td>
                            <td><strong class="text-primary">${{ number_format($property->price, 2) }}</strong></td>
                            <td>
                                <span class="badge {{ $property->availability == 'available' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($property->availability) }}
                                </span>
                            </td>
                            <td>
                                @if($property->is_approved)
                                    <span class="badge bg-info"><i class="bi bi-check-circle"></i> Approved</span>
                                @else
                                    <span class="badge bg-warning text-dark"><i class="bi bi-clock"></i> Pending</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('agent.properties.edit', $property->id) }}" class="btn btn-sm btn-light">Edit</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <p class="text-muted mb-0">You haven't listed any properties yet.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
