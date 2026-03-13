@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-800 mb-0">Platform Users</h3>
    <div class="d-flex gap-2">
         <span class="badge bg-primary-soft text-primary px-3 rounded-pill">Total: {{ $users->count() }}</span>
    </div>
</div>

<div class="card border-0 shadow-sm overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light text-muted small-caps">
                <tr>
                    <th class="ps-4 py-3">Name & Email</th>
                    <th class="py-3">Role</th>
                    <th class="py-3">Joined Date</th>
                    <th class="text-end pe-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="ps-4">
                        <div class="d-flex align-items-center">
                            @if($user->photo)
                                <img src="{{ asset('storage/' . $user->photo) }}" class="rounded-circle me-3" style="width: 45px; height: 45px; object-fit: cover;">
                            @else
                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px; font-weight: 800;">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <div class="fw-bold">{{ $user->name }}</div>
                                <div class="text-muted extra-small" style="font-size: 0.75rem;">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        @if($user->role == 'admin')
                            <span class="badge bg-danger-subtle text-danger">Super Admin</span>
                        @elseif($user->role == 'agent')
                            <span class="badge bg-success-subtle text-success">Professional Agent</span>
                        @else
                            <span class="badge bg-info-subtle text-info">Regular client</span>
                        @endif
                    </td>
                    <td class="small fw-500">{{ $user->created_at->format('M d, Y') }}</td>
                    <td class="text-end pe-4">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light rounded-3" type="button" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 overflow-hidden">
                                <li><a class="dropdown-item py-2 fw-bold" href="#"><i class="bi bi-pencil me-2"></i> Edit Account</a></li>
                                <li><a class="dropdown-item py-2 fw-bold text-danger" href="#"><i class="bi bi-trash me-2"></i> Suspend User</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('styles')
<style>
    .bg-success-subtle { background-color: rgba(25, 135, 84, 0.1) !important; }
    .bg-info-subtle { background-color: rgba(13, 202, 240, 0.1) !important; }
    .bg-danger-subtle { background-color: rgba(220, 53, 69, 0.1) !important; }
    .bg-primary-soft { background: rgba(79, 70, 229, 0.1); color: var(--primary); }
    .small-caps { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; }
</style>
@endsection
