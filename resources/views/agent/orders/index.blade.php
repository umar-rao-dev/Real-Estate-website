@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-800 mb-0">Property Purchase Requests</h3>
    <span class="badge bg-primary-soft text-primary px-3 rounded-pill">Total: {{ $orders->count() }}</span>
</div>

@if(session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="card border-0 shadow-sm overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light text-muted small-caps">
                <tr>
                    <th class="ps-4 py-3">Client / Buyer</th>
                    <th class="py-3">Target Property</th>
                    <th class="py-3">Status</th>
                    <th class="py-3">Request Date</th>
                    <th class="text-end pe-4 py-3">Management</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td class="ps-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-info bg-opacity-10 text-info rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px; font-weight: 800;">
                                {{ substr($order->buyer->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="fw-bold">{{ $order->buyer->name }}</div>
                                <div class="text-muted extra-small" style="font-size: 0.75rem;">{{ $order->buyer->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="fw-bold text-dark">{{ $order->property->name }}</div>
                        <div class="text-primary small fw-800">${{ number_format($order->property->price) }}</div>
                    </td>
                    <td>
                        @if($order->status == 'pending')
                            <span class="badge bg-warning-subtle text-warning">Awaiting Decision</span>
                        @elseif($order->status == 'approved')
                            <span class="badge bg-success-subtle text-success">Approved / Sold</span>
                        @else
                            <span class="badge bg-danger-subtle text-danger">Rejected</span>
                        @endif
                    </td>
                    <td class="small fw-500">{{ $order->created_at->format('M d, Y') }}</td>
                    <td class="text-end pe-4">
                        @if($order->status == 'pending')
                            <div class="d-flex justify-content-end gap-2">
                                <form action="{{ route('agent.orders.update', $order->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="btn btn-sm btn-success rounded-3 px-3 fw-bold" onclick="return confirm('Accept this buy request? Property will be marked as Sold.')">
                                        Accept
                                    </button>
                                </form>
                                <form action="{{ route('agent.orders.update', $order->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-3 px-3 fw-bold" onclick="return confirm('Decline this request?')">
                                        Decline
                                    </button>
                                </form>
                            </div>
                        @else
                            <span class="text-muted extra-small">Request Closed</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <div class="opacity-25 mb-3"><i class="bi bi-cart-x fs-1"></i></div>
                        <p class="text-muted fw-bold">No purchase requests for your properties yet.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('styles')
<style>
    .bg-success-subtle { background-color: rgba(25, 135, 84, 0.1) !important; }
    .bg-warning-subtle { background-color: rgba(255, 193, 7, 0.1) !important; }
    .bg-danger-subtle { background-color: rgba(220, 53, 69, 0.1) !important; }
    .bg-primary-soft { background: rgba(79, 70, 229, 0.1); color: var(--primary); }
    .small-caps { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; }
</style>
@endsection
