@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">System Feedback</h1>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>User</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($feedback as $item)
                        <tr>
                            <td class="ps-4">{{ $item->id }}</td>
                            <td>
                                <strong>{{ $item->user->name }}</strong><br>
                                <small class="text-muted">{{ $item->user->email }}</small>
                            </td>
                            <td>{{ $item->message }}</td>
                            <td>{{ $item->created_at->format('M d, Y') }}</td>
                            <td class="text-end pe-4">
                                <button class="btn btn-sm btn-outline-danger" onclick="confirm('Delete this feedback?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="bi bi-chat-left-text fs-1 text-muted"></i>
                                <p class="text-muted mt-2">No feedback found</p>
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
