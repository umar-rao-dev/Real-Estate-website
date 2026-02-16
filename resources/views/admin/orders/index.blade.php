@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">System Purchase Orders</h1>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Date</th>
                            <th>Buyer</th>
                            <th>Property</th>
                            <th>Agent</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td class="ps-4 text-muted small">{{ $order->created_at->format('M d, Y') }}</td>
                            <td>
                                <strong>{{ $order->buyer->name }}</strong><br>
                                <small class="text-muted">{{ $order->buyer->email }}</small>
                            </td>
                            <td>
                                <a href="{{ route('properties.show', $order->property->id) }}" class="text-decoration-none fw-bold">
                                    {{ $order->property->name }}
                                </a>
                                <div class="text-muted small">${{ number_format($order->property->price) }}</div>
                            </td>
                            <td>{{ $order->agent->name }}</td>
                            <td>
                                <span class="badge {{ $order->status == 'pending' ? 'bg-warning' : ($order->status == 'approved' ? 'bg-success' : 'bg-danger') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">No orders found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
