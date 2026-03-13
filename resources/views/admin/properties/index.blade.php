@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold mb-0">Manage All Properties</h3>
    <a href="{{ route('admin.properties.create') }}" class="btn btn-gradient">
        <i class="bi bi-plus-lg me-2"></i> Add Property
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="card p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light text-muted small">
                <tr>
                    <th class="ps-4 py-3">Property</th>
                    <th class="py-3">Agent</th>
                    <th class="py-3">Stats</th>
                    <th class="py-3">Status</th>
                    <th class="py-3 text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($properties as $p)
                <tr>
                    <td class="ps-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-light rounded-3 p-2 me-3" style="width: 50px; height: 50px; display: flex; align-items:center; justify-content:center;">
                                <i class="bi bi-building-fill text-primary"></i>
                            </div>
                            <div>
                                <div class="fw-bold">{{ $p->name }}</div>
                                <div class="text-muted small">{{ $p->location }} | {{ $p->category->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="small fw-500">{{ $p->user->name }}</div>
                        <div class="text-muted extra-small">{{ $p->user->email }}</div>
                    </td>
                    <td>
                        <div class="d-flex gap-3 small text-muted">
                            <span><i class="bi bi-door-open me-1"></i>{{ $p->beds }}</span>
                            <span><i class="bi bi-water me-1"></i>{{ $p->baths }}</span>
                            <span><i class="bi bi-aspect-ratio me-1"></i>{{ $p->area }} SqFt</span>
                        </div>
                    </td>
                    <td>
                        @if($p->status == 'approved')
                            <span class="badge bg-success-subtle text-success">Approved</span>
                        @elseif($p->status == 'pending')
                            <span class="badge bg-warning-subtle text-warning">Pending</span>
                        @else
                            <span class="badge bg-danger-subtle text-danger">Rejected</span>
                        @endif
                    </td>
                    <td class="text-end pe-4">
                        <div class="d-flex justify-content-end gap-2">
                            @if($p->status == 'pending')
                                <form action="{{ route('admin.properties.approve', $p->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success rounded-3 px-3">Approve</button>
                                </form>
                                <form action="{{ route('admin.properties.reject', $p->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-3 px-3">Reject</button>
                                </form>
                            @elseif($p->status == 'rejected')
                                <form action="{{ route('admin.properties.approve', $p->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-success rounded-3 px-3">Approve</button>
                                </form>
                            @else
                                <form action="{{ route('admin.properties.reject', $p->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-3 px-3">Reject</button>
                                </form>
                            @endif
                            
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light rounded-3" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                                    <li><a class="dropdown-item" href="{{ route('admin.properties.edit', $p->id) }}">Edit</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('admin.properties.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Delete this property permanentely?')">
                                            @csrf @method('DELETE')
                                            <button class="dropdown-item text-danger">Delete</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <div class="text-muted">No properties found.</div>
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
    .extra-small { font-size: 0.75rem; }
</style>
@endsection
