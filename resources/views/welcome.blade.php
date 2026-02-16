@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container py-5">
        <h1 class="display-3 fw-bold mb-4">Find Your <span class="text-warning">Dream</span> Home Today</h1>
        <p class="lead mb-5 opacity-75">Browse from thousands of premium real estate listings for sale and rent.</p>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg p-3 rounded-pill bg-white">
                    <form action="{{ route('properties.index') }}" method="GET" class="row g-2 align-items-center">
                        <div class="col-md-7">
                            <input type="text" name="keyword" class="form-control border-0 shadow-none px-4" placeholder="Search by location or name...">
                        </div>
                        <div class="col-md-3 border-start">
                            <select name="type" class="form-select border-0 shadow-none">
                                <option value="">Type</option>
                                <option value="buy">For Sale</option>
                                <option value="rent">For Rent</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100 rounded-pill py-2">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Properties -->
<section class="py-5">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="fw-bold fs-1">Latest Listings</h2>
                <p class="text-muted">Handpicked premium properties for you.</p>
            </div>
            <a href="{{ route('properties.index') }}" class="btn btn-outline-primary mb-3">View All</a>
        </div>

        <div class="row g-4">
            @forelse($featuredProperties as $property)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden card-hover">
                    <div class="position-relative">
                        @php
                            $imageUrl = $property->images->count() > 0 
                                ? asset('storage/' . $property->images->first()->image_path) 
                                : 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=500&q=80';
                        @endphp
                        <img src="{{ $imageUrl }}" class="card-img-top" style="height: 250px; object-fit: cover;">
                        <span class="position-absolute top-0 end-0 m-3 badge bg-primary px-3 py-2 rounded-pill shadow">{{ ucfirst($property->type) }}</span>
                    </div>
                    <div class="card-body p-4">
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
                <p class="text-muted">No properties found.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Announcements -->
@if($announcements->count() > 0)
<section class="py-5 bg-light">
    <div class="container py-5">
        <h2 class="fw-bold text-center mb-5">Latest News</h2>
        <div class="row g-4">
            @foreach($announcements as $ann)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                    <span class="text-primary small fw-bold mb-2">{{ $ann->created_at->format('M d, Y') }}</span>
                    <h5 class="fw-bold mb-3">{{ $ann->title }}</h5>
                    <p class="text-muted small mb-0">{{ Str::limit($ann->description, 150) }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Become Agent CTA -->
<section class="py-5">
    <div class="container py-5">
        <div class="bg-primary rounded-4 p-5 text-center text-white shadow-lg">
            <h2 class="display-5 fw-bold mb-3">Want to sell your property?</h2>
            <p class="lead mb-4 opacity-75">Join as an agent and list your properties in front of thousands of buyers.</p>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5 text-primary fw-bold rounded-pill">Get Started</a>
        </div>
    </div>
</section>

<style>
    .card-hover { transition: transform 0.3s ease; }
    .card-hover:hover { transform: translateY(-10px); }
</style>
@endsection
