@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">My Property Orders</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Buyer</th>
                            <th>Property</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td class="ps-4">
                                <strong>{{ $order->buyer->name }}</strong><br>
                                <small class="text-muted">{{ $order->buyer->email }}</small>
                            </td>
                            <td>
                                <div class="fw-bold">{{ $order->property->name }}</div>
                                <div class="text-muted small">${{ number_format($order->property->price) }}</div>
                            </td>
                            <td class="small">{{ $order->created_at->format('M d, Y') }}</td>
                            <td>
                                <span class="badge {{ $order->status == 'pending' ? 'bg-warning text-dark' : ($order->status == 'approved' ? 'bg-success' : 'bg-danger') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                @if($order->status == 'pending')
                                    <form action="{{ route('agent.orders.update', $order->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                    </form>
                                    <form action="{{ route('agent.orders.update', $order->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Reject</button>
                                    </form>
                                @else
                                    <span class="text-muted small">Processed</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">No purchase orders for your properties.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
