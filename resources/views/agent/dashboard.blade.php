@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="dashboard-hero bg-success" style="background: linear-gradient(135deg, #198754 0%, #0c4d2d 100%);">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="fw-bold mb-2">Hello, Agent {{ auth()->user()->name }}!</h2>
                <p class="lead mb-0 opacity-75">You have {{ $totalOrders }} open purchase orders for your properties.</p>
            </div>
            <div class="col-md-4 text-md-end d-none d-md-block">
                <i class="bi bi-person-check-fill" style="font-size: 5rem; opacity: 0.2;"></i>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4 text-center">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h6 class="text-muted text-uppercase mb-2">My Listings</h6>
                <h2 class="fw-bold text-primary">{{ $totalProperties }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h6 class="text-muted text-uppercase mb-2">Client Queries</h6>
                <h2 class="fw-bold text-success">{{ $totalQueries }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h6 class="text-muted text-uppercase mb-2">Purchase Orders</h6>
                <h2 class="fw-bold text-warning">{{ $totalOrders }}</h2>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">My Latest Properties</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Property</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestProperties as $property)
                                <tr>
                                    <td>
                                        <div class="fw-bold">{{ $property->name }}</div>
                                        <small class="text-muted text-truncate d-block" style="max-width: 150px;">{{ $property->location }}</small>
                                    </td>
                                    <td>${{ number_format($property->price) }}</td>
                                    <td>
                                        <span class="badge {{ $property->availability == 'available' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($property->availability) }}
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
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">Latest Purchase Requests</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Buyer</th>
                                    <th>Property</th>
                                    <th>Action</th>
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
                                        @if($order->status == 'pending')
                                            <a href="{{ route('agent.orders.index') }}" class="btn btn-sm btn-outline-primary">Manage</a>
                                        @else
                                            <span class="badge border {{ $order->status == 'approved' ? 'text-success border-success' : 'text-danger border-danger' }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        @endif
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
