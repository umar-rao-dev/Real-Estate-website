@extends('layouts.app')

@section('content')
<!-- Search Header -->
<section class="hero text-white" style="padding: 60px 0;">
    <div class="container text-center">
        <h1 class="fw-800 display-4 mb-3 animate-up">Discover Your Perfect Space</h1>
        <p class="lead mb-5 opacity-75 animate-up">Browse through thousands of verified properties in your desired location.</p>
        
        <div class="card p-3 border-0 shadow-lg animate-up mx-auto" style="max-width: 900px; border-radius: 24px;">
            <form action="{{ route('properties.index') }}" method="GET" class="row g-2">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-0 ps-3"><i class="bi bi-search text-primary"></i></span>
                        <input type="text" name="keyword" class="form-control border-0 py-3" placeholder="Search by name or location..." value="{{ request('keyword') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="type" class="form-select border-0 py-3 bg-light rounded-3 fw-bold">
                        <option value="">All Types</option>
                        <option value="buy" {{ request('type') == 'buy' ? 'selected' : '' }}>For Sale</option>
                        <option value="rent" {{ request('type') == 'rent' ? 'selected' : '' }}>For Rent</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="category" class="form-select border-0 py-3 bg-light rounded-3 fw-bold">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-premium w-100 h-100 p-0 fs-4 rounded-4"><i class="bi bi-sliders"></i></button>
                </div>
            </form>
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5 animate-up">
        <div>
            <h2 class="fw-800 mb-1">Available Properties</h2>
            <p class="text-muted mb-0">Found {{ $properties->total() }} premium listings</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-white shadow-sm rounded-pill px-4 fw-bold">Newest First <i class="bi bi-chevron-down ms-1"></i></button>
        </div>
    </div>

    <div class="row g-4 animate-up">
        @forelse($properties as $p)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 border-0">
                <div class="position-relative overflow-hidden">
                    @if($p->images->count() > 0)
                        <img src="{{ asset('storage/' . $p->images->first()->image_path) }}" class="card-img-top" style="height: 250px; object-fit: cover;">
                    @else
                        <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=800&q=80" class="card-img-top" style="height: 250px; object-fit: cover;">
                    @endif
                    <div class="position-absolute top-0 start-0 m-3">
                        <span class="badge bg-primary rounded-pill px-3 shadow">{{ ucfirst($p->type) }}</span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-primary fw-bold small">{{ $p->category->name }}</span>
                        <span class="fw-800 text-primary h5 mb-0">${{ number_format($p->price) }}</span>
                    </div>
                    <h5 class="fw-800 mb-2"><a href="{{ route('properties.show', $p->id) }}" class="text-decoration-none text-dark">{{ $p->name }}</a></h5>
                    <p class="text-muted small mb-4"><i class="bi bi-geo-alt-fill me-1"></i> {{ $p->location }}</p>
                    
                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <div class="d-flex gap-3 text-muted small">
                            <span title="Bedrooms"><i class="bi bi-door-open me-1"></i>{{ $p->beds }}</span>
                            <span title="Bathrooms"><i class="bi bi-water me-1"></i>{{ $p->baths }}</span>
                            <span title="Area"><i class="bi bi-aspect-ratio me-1"></i>{{ $p->area }} SqFt</span>
                        </div>
                        <a href="{{ route('properties.show', $p->id) }}" class="btn btn-light btn-sm rounded-pill px-3 fw-bold">View Details</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="bi bi-search display-1 text-muted opacity-25"></i>
            <h3 class="fw-800 mt-4">No Properties Found</h3>
            <p class="text-muted">Try adjusting your filters or keyword search.</p>
            <a href="{{ route('properties.index') }}" class="btn btn-premium mt-3">Reset Filters</a>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5 animate-up">
        {{ $properties->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

@section('styles')
<style>
    .fw-800 { font-weight: 800; }
    .card-img-top { transition: transform 0.5s ease; }
    .card:hover .card-img-top { transform: scale(1.1); }
    .btn-light:hover { background: #e2e8f0; }
    .pagination .page-item .page-link { border-radius: 12px; margin: 0 4px; border: none; font-weight: 700; color: #475569; }
    .pagination .page-item.active .page-link { background: var(--gradient); color: white; }
</style>
@endsection
