@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="dashboard-hero">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="fw-bold mb-2">Admin Control Panel</h2>
                <p class="lead mb-0 opacity-75">Overview of platform activities, properties, and purchase orders.</p>
            </div>
            <div class="col-md-4 text-md-end d-none d-md-block">
                <div class="display-4 fw-bold mb-0 text-white">{{ $totalProperties }}</div>
                <div class="text-uppercase small opacity-75">Total Listings</div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4 text-center">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h6 class="text-muted text-uppercase mb-2">Users</h6>
                <h2 class="fw-bold text-primary">{{ $totalUsers }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h6 class="text-muted text-uppercase mb-2">Agents</h6>
                <h2 class="fw-bold text-success">{{ $totalAgents }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h6 class="text-muted text-uppercase mb-2">Properties</h6>
                <h2 class="fw-bold text-info">{{ $totalProperties }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h6 class="text-muted text-uppercase mb-2">Total Orders</h6>
                <h2 class="fw-bold text-warning">{{ $totalOrders }}</h2>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">Latest Properties</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Property</th>
                                    <th>Price</th>
                                    <th>Agent</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestProperties as $property)
                                <tr>
                                    <td>
                                        <div class="fw-bold text-truncate" style="max-width: 200px;">{{ $property->name }}</div>
                                        <small class="text-muted">{{ $property->location }}</small>
                                    </td>
                                    <td class="text-success fw-bold">${{ number_format($property->price) }}</td>
                                    <td>{{ $property->user->name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">Recent Orders</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Buyer</th>
                                    <th>Property</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestOrders as $order)
                                <tr>
                                    <td>{{ $order->buyer->name }}</td>
                                    <td>
                                        <div class="text-truncate" style="max-width: 150px;">{{ $order->property->name }}</div>
                                    </td>
                                    <td>
                                        <span class="badge border {{ $order->status == 'pending' ? 'text-warning border-warning' : ($order->status == 'approved' ? 'text-success border-success' : 'text-danger border-danger') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
