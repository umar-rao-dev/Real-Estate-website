@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="fw-bold mb-5">Latest Announcements</h1>
            
            @forelse($announcements as $ann)
                <div class="card border-0 shadow-sm mb-4 overflow-hidden">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-1 rounded-pill">
                                {{ $ann->created_at->format('M d, Y') }}
                            </span>
                        </div>
                        <h3 class="fw-bold mb-3 h4">{{ $ann->title }}</h3>
                        <p class="text-muted" style="line-height: 1.8;">
                            {{ $ann->description }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <i class="bi bi-megaphone fs-1 text-muted"></i>
                    <p class="text-muted mt-3">No announcements available at this time.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
