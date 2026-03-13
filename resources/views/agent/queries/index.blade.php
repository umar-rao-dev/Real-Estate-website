@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-800 mb-0">Direct Property Inquiries</h3>
    <span class="badge bg-primary-soft text-primary px-3 rounded-pill">Total: {{ $queries->count() }}</span>
</div>

<div class="card border-0 shadow-sm overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light text-muted small-caps">
                <tr>
                    <th class="ps-4 py-3">Interested Client</th>
                    <th class="py-3">Property Context</th>
                    <th class="py-3">Message</th>
                    <th class="py-3">Inquiry Date</th>
                    <th class="text-end pe-4 py-3">Respond</th>
                </tr>
            </thead>
            <tbody>
                @forelse($queries as $query)
                <tr>
                    <td class="ps-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-secondary bg-opacity-10 text-secondary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px; font-weight: 800;">
                                {{ substr($query->user->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="fw-bold">{{ $query->user->name }}</div>
                                <div class="text-muted extra-small" style="font-size: 0.75rem;">{{ $query->user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="fw-bold text-primary">{{ $query->property->name }}</div>
                        <div class="text-muted small">ID: #{{ $query->property->id }}</div>
                    </td>
                    <td>
                        <div class="text-muted small" title="{{ $query->message }}">
                            {{ Str::limit($query->message, 80) }}
                        </div>
                    </td>
                    <td class="small fw-500">{{ $query->created_at->format('M d, Y') }} at {{ $query->created_at->format('H:i') }}</td>
                    <td class="text-end pe-4">
                        <a href="mailto:{{ $query->user->email }}?subject=Re: Inquiry regarding {{ $query->property->name }}" class="btn btn-sm btn-outline-custom rounded-pill px-3 shadow-sm">
                            <i class="bi bi-envelope-at me-2"></i> Reply Fast
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <div class="opacity-25 mb-3"><i class="bi bi-chat-right-text fs-1"></i></div>
                        <p class="text-muted fw-bold">You haven't received any inquiries yet.</p>
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
    .bg-primary-soft { background: rgba(79, 70, 22, 0.1); color: var(--primary); }
    .small-caps { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; }
    .btn-outline-custom { border-radius: 12px; font-weight: 700; border: 2px solid #e2e8f0; color: #475569; transition: all 0.3s; }
    .btn-outline-custom:hover { background: #6366f1; color: white; border-color: #6366f1; }
</style>
@endsection
