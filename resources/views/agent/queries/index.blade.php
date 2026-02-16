@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Property Queries</h1>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Date</th>
                            <th>User</th>
                            <th>Property</th>
                            <th>Message</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($queries as $query)
                        <tr>
                            <td class="ps-4 text-muted small">{{ $query->created_at->format('M d, Y') }}</td>
                            <td>
                                <strong>{{ $query->user->name }}</strong><br>
                                <small class="text-muted">{{ $query->user->email }}</small>
                            </td>
                            <td>
                                <span class="text-primary">{{ $query->property->title }}</span>
                            </td>
                            <td>{{ Str::limit($query->message, 100) }}</td>
                            <td class="text-end pe-4">
                                <a href="mailto:{{ $query->user->email }}?subject=Re: Query about {{ $query->property->title }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-reply"></i> Reply by Email
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="bi bi-chat-dots fs-1 text-muted"></i>
                                <p class="text-muted mt-2">No queries received yet</p>
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
