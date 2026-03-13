@extends('layouts.admin')

@section('content')
<div class="row g-4 mb-4">
    <!-- Main Stats Row -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50">Total Properties</h6>
                    <h2 class="fw-bold mb-0">{{ $totalProperties }}</h2>
                </div>
                <div class="bg-white bg-opacity-25 rounded-3 p-3">
                    <i class="bi bi-building fs-3"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50">Approved Properties</h6>
                    <h2 class="fw-bold mb-0">{{ $approvedProperties }}</h2>
                </div>
                <div class="bg-white bg-opacity-25 rounded-3 p-3">
                    <i class="bi bi-check-circle fs-3"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50">Pending Approval</h6>
                    <h2 class="fw-bold mb-0">{{ $pendingProperties }}</h2>
                </div>
                <div class="bg-white bg-opacity-25 rounded-3 p-3">
                    <i class="bi bi-clock-history fs-3"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white p-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50">Rejected</h6>
                    <h2 class="fw-bold mb-0">{{ $rejectedProperties }}</h2>
                </div>
                <div class="bg-white bg-opacity-25 rounded-3 p-3">
                    <i class="bi bi-x-circle fs-3"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- User/Agent Stats -->
    <div class="col-md-6 mb-4">
        <div class="card h-100 p-4">
            <h5 class="fw-bold mb-4">Users & Agents Overview</h5>
            <div class="row text-center">
                <div class="col-6 border-end">
                    <h3 class="fw-bold text-primary">{{ $totalUsers }}</h3>
                    <span class="text-muted">Total Users</span>
                </div>
                <div class="col-6">
                    <h3 class="fw-bold text-purple" style="color: #a855f7;">{{ $totalAgents }}</h3>
                    <span class="text-muted">Total Agents</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Order Stats -->
    <div class="col-md-6 mb-4">
        <div class="card h-100 p-4">
            <h5 class="fw-bold mb-4">Total Orders Overview</h5>
             <div class="d-flex align-items-center justify-content-center h-100">
                <div class="text-center">
                    <h1 class="display-3 fw-bold text-gradient-text" style="background: var(--primary-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">{{ $totalOrders }}</h1>
                    <p class="text-muted fw-500">Total Buy Requests Received</p>
                </div>
             </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Latest Properties</h5>
                <a href="{{ route('admin.properties.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="text-muted small">
                        <tr>
                            <th>Property Name</th>
                            <th>Agent</th>
                            <th>Status</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latestProperties as $p)
                        <tr>
                            <td>
                                <div class="fw-bold">{{ $p->name }}</div>
                                <span class="text-muted small">{{ $p->location }}</span>
                            </td>
                            <td>{{ $p->user->name }}</td>
                            <td>
                                @if($p->status == 'approved')
                                    <span class="badge bg-success-subtle text-success">Approved</span>
                                @elseif($p->status == 'pending')
                                    <span class="badge bg-warning-subtle text-warning">Pending</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger">Rejected</span>
                                @endif
                            </td>
                            <td class="fw-bold text-primary">${{ number_format($p->price) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 mb-4">
        <div class="card p-4 h-100">
             <h5 class="fw-bold mb-4">Recent Activity</h5>
             @foreach($latestOrders as $o)
             <div class="d-flex align-items-center mb-3 pb-3 border-bottom last-child-no-border">
                <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3">
                    <i class="bi bi-cart"></i>
                </div>
                <div>
                    <div class="fw-bold small">{{ $o->buyer->name }}</div>
                    <div class="text-muted" style="font-size: 0.75rem;">Requested {{ $o->property->name }}</div>
                </div>
                <div class="ms-auto">
                    <span class="text-muted extra-small" style="font-size: 0.7rem;">{{ $o->created_at->diffForHumans() }}</span>
                </div>
             </div>
             @endforeach
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .bg-success-subtle { background-color: rgba(25, 135, 84, 0.1) !important; }
    .bg-warning-subtle { background-color: rgba(255, 193, 7, 0.1) !important; }
    .bg-danger-subtle { background-color: rgba(220, 53, 69, 0.1) !important; }
    .last-child-no-border:last-child { border-bottom: none !important; }
</style>
@endsection
