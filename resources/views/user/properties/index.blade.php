@extends('layouts.app')

@section('content')
<div class="hero-section py-5">
    <div class="container text-center py-4">
        <h1 class="fw-bold mb-0 text-white">Browse Properties</h1>
        <p class="lead text-white-50">Find your next home from our curated selection of properties.</p>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        <!-- Filters Sidebar -->
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm p-4 sticky-top" style="top: 100px;">
                <h5 class="fw-bold mb-4">Search & Filters</h5>
                <form action="{{ route('properties.index') }}" method="GET">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Keyword</label>
                        <input type="text" name="keyword" class="form-control" placeholder="City or name..." value="{{ request('keyword') }}">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Type</label>
                        <select name="type" class="form-select">
                            <option value="">Any Type</option>
                            <option value="buy" {{ request('type') == 'buy' ? 'selected' : '' }}>For Sale</option>
                            <option value="rent" {{ request('type') == 'rent' ? 'selected' : '' }}>For Rent</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                    <a href="{{ route('properties.index') }}" class="btn btn-link w-100 text-decoration-none mt-2 small">Reset</a>
                </form>
            </div>
        </div>

        <!-- Property Grid -->
        <div class="col-lg-9">
            <div class="row g-4">
                @forelse($properties as $property)
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden card-hover">
                        <div class="position-relative">
                            @php
                                $imageUrl = $property->images->count() > 0 
                                    ? asset('storage/' . $property->images->first()->image_path) 
                                    : 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=500&q=80';
                            @endphp
                            <img src="{{ $imageUrl }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                            <span class="position-absolute top-0 end-0 m-3 badge bg-primary px-3 py-2 rounded-pill shadow">{{ ucfirst($property->type) }}</span>
                        </div>
                        <div class="card-body p-4 text-start">
                            <div class="text-primary small fw-bold mb-1">{{ strtoupper($property->category->name) }}</div>
                            <h5 class="fw-bold mb-2"><a href="{{ route('properties.show', $property->id) }}" class="text-decoration-none text-dark">{{ $property->name }}</a></h5>
                            <p class="text-muted small mb-3"><i class="bi bi-geo-alt"></i> {{ $property->location }}</p>
                            <div class="h5 fw-bold text-primary mb-3">${{ number_format($property->price) }}</div>
                            <div class="d-flex justify-content-between text-muted small border-top pt-3">
                                <span><i class="bi bi-door-open"></i> {{ $property->beds }} Bds</span>
                                <span><i class="bi bi-droplet"></i> {{ $property->baths }} Bths</span>
                                <span><i class="bi bi-bounding-box"></i> {{ $property->area }} sqft</span>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-search fs-1 text-muted mb-3 d-block"></i>
                    <h4>No Properties Found</h4>
                    <p class="text-muted">Try adjusting your filters or search keywords.</p>
                </div>
                @endforelse
            </div>

            <div class="mt-5 d-flex justify-content-center">
                {{ $properties->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

<style>
    .card-hover { transition: transform 0.3s ease; }
    .card-hover:hover { transform: translateY(-10px); }
</style>
@endsection
