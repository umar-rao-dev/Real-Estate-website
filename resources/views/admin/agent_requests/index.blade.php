@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Agent Requests</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>User</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $req)
                        <tr>
                            <td class="ps-4">{{ $req->id }}</td>
                            <td>
                                <strong>{{ $req->user->name }}</strong><br>
                                <small class="text-muted">{{ $req->user->email }}</small>
                            </td>
                            <td>{{ Str::limit($req->message, 100) }}</td>
                            <td>
                                @if($req->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($req->status == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>
                            <td>{{ $req->created_at->format('M d, Y') }}</td>
                            <td class="text-end pe-4">
                                @if($req->status == 'pending')
                                    <form action="{{ route('admin.agent-requests.approve', $req->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-success me-1" onclick="return confirm('Approve this request?')">
                                            <i class="bi bi-check-lg"></i> Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.agent-requests.reject', $req->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Reject this request?')">
                                            <i class="bi bi-x-lg"></i> Reject
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted small">No actions available</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="bi bi-person-badge fs-1 text-muted"></i>
                                <p class="text-muted mt-2">No agent requests found</p>
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
