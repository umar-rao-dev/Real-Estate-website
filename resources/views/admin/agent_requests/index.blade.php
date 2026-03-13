@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-800 mb-0">Agent Applications</h3>
    <span class="badge bg-primary-soft text-primary px-3">{{ $requests->count() }} Total Requests</span>
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
                    <th class="ps-4 py-3">User Details</th>
                    <th class="py-3">Message Snippet</th>
                    <th class="py-3">Status</th>
                    <th class="py-3">Applied Date</th>
                    <th class="text-end pe-4 py-3">Decision</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $req)
                <tr>
                    <td class="ps-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px; font-weight: 800;">
                                {{ substr($req->user->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="fw-bold">{{ $req->user->name }}</div>
                                <div class="text-muted extra-small" style="font-size: 0.75rem;">{{ $req->user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="text-muted small" title="{{ $req->message }}">
                            {{ Str::limit($req->message, 80) }}
                        </div>
                    </td>
                    <td>
                        @if($req->status == 'pending')
                            <span class="badge bg-warning-subtle text-warning">Pending Review</span>
                        @elseif($req->status == 'approved')
                            <span class="badge bg-success-subtle text-success">Approved</span>
                        @else
                            <span class="badge bg-danger-subtle text-danger">Rejected</span>
                        @endif
                    </td>
                    <td class="small fw-500">{{ $req->created_at->format('M d, Y') }}</td>
                    <td class="text-end pe-4">
                        @if($req->status == 'pending')
                            <div class="d-flex justify-content-end gap-2">
                                <form action="{{ route('admin.agent-requests.approve', $req->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-success rounded-3 px-3 fw-bold" onclick="return confirm('Upgrade this user to Agent?')">
                                        Approve
                                    </button>
                                </form>
                                <form action="{{ route('admin.agent-requests.reject', $req->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-danger rounded-3 px-3 fw-bold" onclick="return confirm('Reject this application?')">
                                        Reject
                                    </button>
                                </form>
                            </div>
                        @else
                            <span class="text-muted extra-small">Processed</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <div class="opacity-25 mb-3"><i class="bi bi-person-badge fs-1"></i></div>
                        <p class="text-muted fw-bold">No pending agent requests found.</p>
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
