@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero-section position-relative py-5 overflow-hidden border-bottom" style="background: linear-gradient(135deg, #f0f7ff 0%, #ffffff 100%);">
    <div class="container py-5">
        <div class="row align-items-center py-5">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill mb-3">Premium Real Estate</span>
                <h1 class="display-3 fw-bold mb-4" style="line-height: 1.1; color: #08244b;">Find Your <span class="text-primary">Perfect</span> Home For Living</h1>
                <p class="lead text-muted mb-5">Explore from over 1,500+ properties located in prime areas. Whether you're looking to buy or rent, we've got you covered.</p>
                
                <div class="search-box p-3 bg-white shadow-lg rounded-4 d-none d-md-block">
                    <form action="{{ route('properties.index') }}" method="GET" class="row g-2">
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-0"><i class="bi bi-search text-primary"></i></span>
                                <input type="text" name="keyword" class="form-control border-0 shadow-none" placeholder="Location, Title...">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="type" class="form-select border-0 shadow-none">
                                <option value="">Any Type</option>
                                <option value="buy">For Sale</option>
                                <option value="rent">For Rent</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary w-100 py-2">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="position-relative ms-lg-5">
                    <img src="https://images.unsplash.com/photo-1582408921715-18e7806367c1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Hero Image" class="img-fluid rounded-4 shadow-lg border">
                    <div class="position-absolute bottom-0 start-0 translate-middle-x mb-5 bg-white p-3 rounded-3 shadow d-none d-lg-block border-start border-primary border-4">
                        <h6 class="mb-1 fw-bold">1.2k+ Properties</h6>
                        <p class="small text-muted mb-0">Across different cities</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Properties -->
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold h1 mb-3">Featured Properties</h2>
            <p class="text-muted mx-auto" style="max-width: 600px;">Handpicked properties that offer the best value and location. Browse through our premium selections.</p>
        </div>

        <div class="row g-4">
            @forelse($featuredProperties as $property)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm overflow-hidden">
                    <div class="position-relative">
                        @if($property->images->count() > 0)
                            <img src="{{ asset('storage/' . $property->images->first()->image_path) }}" class="card-img-top" alt="{{ $property->title }}" style="height: 240px; object-fit: cover;">
                        @else
                            <img src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=500&q=80" class="card-img-top" alt="Default" style="height: 240px; object-fit: cover;">
                        @endif
                        <div class="position-absolute top-0 start-0 m-3">
                            <span class="badge {{ $property->type == 'buy' ? 'bg-primary' : 'bg-success' }} px-3 py-2 rounded-pill shadow">
                                {{ $property->type == 'buy' ? 'For Sale' : 'For Rent' }}
                            </span>
                        </div>
                        <div class="position-absolute bottom-0 start-0 m-3 px-3 py-1 bg-white bg-opacity-75 rounded-pill shadow-sm">
                            <span class="fw-bold text-primary">${{ number_format($property->price) }}</span>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <small class="text-primary fw-bold text-uppercase mb-2 d-inline-block">{{ $property->category->name }}</small>
                        <h5 class="card-title fw-bold mb-3"><a href="{{ route('properties.show', $property->id) }}" class="text-decoration-none text-dark">{{ $property->title }}</a></h5>
                        <p class="text-muted small mb-4"><i class="bi bi-geo-alt me-1"></i> {{ $property->location }}</p>
                        
                        <div class="d-flex justify-content-between border-top pt-3">
                            <span class="text-muted small"><i class="bi bi-door-open me-1"></i> {{ $property->beds }} Bds</span>
                            <span class="text-muted small"><i class="bi bi-droplet me-1"></i> {{ $property->baths }} Bths</span>
                            <span class="text-muted small"><i class="bi bi-bounding-box me-1"></i> {{ $property->area }} sqft</span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">No featured properties at the moment.</p>
            </div>
            @endforelse
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('properties.index') }}" class="btn btn-outline-primary px-5">View All Properties</a>
        </div>
    </div>
</section>

<!-- Announcements Section -->
@if(isset($announcements) && $announcements->count() > 0)
<section class="py-5 border-top bg-white">
    <div class="container py-5">
        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <h2 class="fw-bold mb-0">Latest Announcements</h2>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="text-muted mb-0">Stay updated with the latest news and offers.</p>
            </div>
        </div>
        <div class="row g-4">
            @foreach($announcements as $ann)
            <div class="col-md-4">
                <div class="card h-100 border-0 bg-light p-4">
                    <div class="card-body p-0">
                        <div class="badge bg-primary-subtle text-primary mb-3">{{ $ann->created_at->format('M d, Y') }}</div>
                        <h5 class="fw-bold mb-3">{{ $ann->title }}</h5>
                        <p class="text-muted small mb-0">{{ Str::limit($ann->description, 120) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Call to Action -->
<section class="py-5">
    <div class="container py-5">
        <div class="bg-primary rounded-4 p-5 position-relative overflow-hidden shadow-lg">
            <div class="row align-items-center position-relative" style="z-index: 2;">
                <div class="col-lg-7 text-white">
                    <h2 class="display-5 fw-bold mb-3">Become a Real Estate Agent?</h2>
                    <p class="lead opacity-75 mb-4">Join our network of elite agents and start listing your properties today. We provide the tools and platform you need to succeed.</p>
                    <a href="{{ route('user.dashboard') }}" class="btn btn-light btn-lg px-5 text-primary fw-bold">Join Now</a>
                </div>
                <div class="col-lg-5 text-end d-none d-lg-block">
                    <i class="bi bi-person-badge-fill text-white opacity-25" style="font-size: 10rem;"></i>
                </div>
            </div>
            <!-- Decorative circle -->
            <div class="position-absolute top-0 end-0 bg-white opacity-10 rounded-circle" style="width: 300px; height: 300px; margin-top: -150px; margin-right: -150px;"></div>
        </div>
    </div>
</section>
@endsection
