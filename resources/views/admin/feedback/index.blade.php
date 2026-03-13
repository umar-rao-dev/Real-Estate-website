@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-800 mb-0">Customer Feedback</h3>
    <span class="badge bg-primary-soft text-primary px-3 rounded-pill">Total: {{ $feedback->count() }}</span>
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
                    <th class="ps-4 py-3">Client</th>
                    <th class="py-3">Subject</th>
                    <th class="py-3">Message Snippet</th>
                    <th class="py-3">Submitted</th>
                    <th class="text-end pe-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($feedback as $f)
                <tr>
                    <td class="ps-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; font-weight: 800;">
                                {{ $f->user ? substr($f->user->name, 0, 1) : 'G' }}
                            </div>
                            <div>
                                <div class="fw-bold">{{ $f->user ? $f->user->name : 'Guest User' }}</div>
                                <div class="text-muted extra-small" style="font-size: 0.7rem;">{{ $f->user ? $f->user->email : 'No Email' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="fw-bold">{{ $f->subject }}</td>
                    <td>
                        <div class="text-muted small" title="{{ $f->message }}">
                            {{ Str::limit($f->message, 80) }}
                        </div>
                    </td>
                    <td class="small fw-500">{{ $f->created_at->format('M d, Y') }}</td>
                    <td class="text-end pe-4">
                        <form action="{{ route('admin.feedback.destroy', $f->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-light text-danger rounded-3" onclick="return confirm('Delete this feedback?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <div class="opacity-25 mb-3"><i class="bi bi-chat-left-dots fs-1"></i></div>
                        <p class="text-muted fw-bold">No feedback received yet.</p>
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
    .bg-primary-soft { background: rgba(79, 70, 229, 0.1); color: var(--primary); }
    .small-caps { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; }
</style>
@endsection
