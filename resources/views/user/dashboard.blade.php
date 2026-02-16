@extends('layouts.app')

@section('content')
<!-- Personalized Hero -->
<section class="py-5 bg-primary hero-section-user" style="min-height: 300px; background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-4.0.3&auto=format&fit=crop&w=1500&q=80'); background-size: cover; background-position: center; display: flex; align-items: center;">
    <div class="container text-center text-white">
        <h1 class="display-4 fw-bold mb-3">Welcome Back, {{ auth()->user()->name }}!</h1>
        <p class="lead mb-4">Start your journey to find the perfect home today.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('properties.index') }}" class="btn btn-primary btn-lg px-4 border-white">Browse All Properties</a>
            @if(!auth()->user()->isAgent())
                <button class="btn btn-outline-light btn-lg px-4" data-bs-toggle="modal" data-bs-target="#becomeAgentModal">Become an Agent</button>
            @endif
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="row">
        <!-- Main Feed -->
        <div class="col-lg-8">
            <h3 class="fw-bold mb-4">Featured for You</h3>
            <div class="row g-4">
                @foreach($featuredProperties as $property)
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        @if($property->images->count() > 0)
                            <img src="{{ asset('storage/' . $property->images->first()->image_path) }}" class="card-img-top" alt="..." style="height: 200px; object-fit: cover;">
                        @else
                            <img src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=500&q=80" class="card-img-top" style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="fw-bold"><a href="{{ route('properties.show', $property->id) }}" class="text-decoration-none text-dark">{{ $property->title }}</a></h5>
                            <p class="text-muted small mb-0"><i class="bi bi-geo-alt"></i> {{ $property->location }}</p>
                            <div class="mt-3 d-flex justify-content-between">
                                <span class="fw-bold text-primary">${{ number_format($property->price) }}</span>
                                <span class="badge bg-light text-dark border">{{ ucfirst($property->type) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Announcements -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Announcements</h5>
                </div>
                <div class="card-body">
                    @forelse($announcements as $ann)
                    <div class="mb-3 pb-3 border-bottom last-child-no-border">
                        <small class="text-primary fw-bold">{{ $ann->created_at->format('M d') }}</small>
                        <h6 class="fw-bold mt-1">{{ $ann->title }}</h6>
                        <p class="text-muted small mb-0">{{ Str::limit($ann->description, 80) }}</p>
                    </div>
                    @empty
                    <p class="text-muted small">No recent announcements.</p>
                    @endforelse
                </div>
            </div>

            <!-- Profile Overview Quick Links -->
            <div class="card border-0 shadow-sm p-4">
                <h5 class="fw-bold mb-3">Quick Actions</h5>
                <div class="list-group list-group-flush">
                    <a href="{{ route('user.profile.index') }}" class="list-group-item list-group-item-action border-0 px-0">
                        <i class="bi bi-person me-2"></i> Update Profile
                    </a>
                    <a href="{{ route('properties.index', ['type' => 'buy']) }}" class="list-group-item list-group-item-action border-0 px-0">
                        <i class="bi bi-house me-2"></i> Buying Properties
                    </a>
                    <a href="{{ route('properties.index', ['type' => 'rent']) }}" class="list-group-item list-group-item-action border-0 px-0">
                        <i class="bi bi-key me-2"></i> Renting Properties
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Become Agent Modal -->
<div class="modal fade" id="becomeAgentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold">Become an Agent</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('user.agent-request.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <p class="text-muted">Send a request to the admin to upgrade your account to an Agent role. This will allow you to list your own properties.</p>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Why do you want to become an agent?</label>
                        <textarea name="message" class="form-control" rows="4" placeholder="Briefly describe your experience or intent..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">Submit Request</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .last-child-no-border:last-child {
        border-bottom: none !important;
    }
</style>
@endsection
