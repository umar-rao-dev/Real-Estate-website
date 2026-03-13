@extends('layouts.admin')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-xl-4 col-md-6">
        <div class="card p-4 border-0 shadow-sm" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);">
            <div class="d-flex justify-content-between align-items-center text-white">
                <div>
                    <h6 class="opacity-75">My Total Listings</h6>
                    <h2 class="fw-bold mb-0">{{ $totalProperties }}</h2>
                </div>
                <div class="bg-white bg-opacity-20 rounded-circle p-3">
                    <i class="bi bi-house-door fs-3"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="card p-4 border-0 shadow-sm" style="background: linear-gradient(135deg, #10b981 0%, #34d399 100%);">
            <div class="d-flex justify-content-between align-items-center text-white">
                <div>
                    <h6 class="opacity-75">Client Queries</h6>
                    <h2 class="fw-bold mb-0">{{ $totalQueries }}</h2>
                </div>
                <div class="bg-white bg-opacity-20 rounded-circle p-3">
                    <i class="bi bi-chat-dots fs-3"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="card p-4 border-0 shadow-sm" style="background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);">
            <div class="d-flex justify-content-between align-items-center text-white">
                <div>
                    <h6 class="opacity-75">Purchase Orders</h6>
                    <h2 class="fw-bold mb-0">{{ $totalOrders }}</h2>
                </div>
                <div class="bg-white bg-opacity-20 rounded-circle p-3">
                    <i class="bi bi-cart fs-3"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-7 mb-4">
        <div class="card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">My Recent Listings</h5>
                <a href="{{ route('agent.properties.index') }}" class="btn btn-sm btn-outline-primary shadow-sm">Manage All</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light text-muted small">
                        <tr>
                            <th>Property</th>
                            <th>Status</th>
                            <th>Availability</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestProperties as $p)
                        <tr>
                            <td>
                                <div class="fw-bold">{{ $p->name }}</div>
                                <div class="text-muted small">${{ number_format($p->price) }}</div>
                            </td>
                            <td>
                                @if($p->status == 'approved')
                                    <span class="badge bg-success-subtle text-success">Live</span>
                                @elseif($p->status == 'pending')
                                    <span class="badge bg-warning-subtle text-warning">Pending</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger">Rejected</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $p->availability == 'available' ? 'bg-info-subtle text-info' : 'bg-secondary-subtle text-secondary' }}">
                                    {{ ucfirst($p->availability) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center py-4 text-muted">No listings yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-lg-5 mb-4">
        <div class="card p-4 h-100">
            <h5 class="fw-bold mb-4">Recent Buy Requests</h5>
            @forelse($latestOrders as $o)
            <div class="d-flex align-items-center mb-3 pb-3 border-bottom last-child-no-border">
                <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3">
                    <i class="bi bi-person"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="fw-bold small">{{ $o->buyer->name }}</div>
                    <div class="text-muted extra-small">Interested in: {{ $o->property->name }}</div>
                </div>
                <div>
                     <span class="badge {{ $o->status == 'pending' ? 'bg-warning-subtle text-warning' : ($o->status == 'approved' ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger') }} small">
                        {{ ucfirst($o->status) }}
                     </span>
                </div>
            </div>
            @empty
            <p class="text-muted text-center py-5">No requests received.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .bg-success-subtle { background-color: rgba(25, 135, 84, 0.1) !important; }
    .bg-warning-subtle { background-color: rgba(255, 193, 7, 0.1) !important; }
    .bg-danger-subtle { background-color: rgba(220, 53, 69, 0.1) !important; }
    .bg-info-subtle { background-color: rgba(13, 202, 240, 0.1) !important; }
    .bg-secondary-subtle { background-color: rgba(108, 117, 125, 0.1) !important; }
    .last-child-no-border:last-child { border-bottom: none !important; }
    .extra-small { font-size: 0.7rem; }
</style>
@endsection
