@extends('layouts.app')

@section('content')
<div class="bg-primary-subtle py-5">
    <div class="container py-4">
        <h1 class="fw-bold mb-0">Browse Properties</h1>
        <p class="text-muted">Discover the perfect space from over {{ $properties->total() }} results.</p>
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
                        <label class="form-label small fw-bold text-muted text-uppercase">Keyword</label>
                        <input type="text" name="keyword" class="form-control" placeholder="City, address..." value="{{ request('keyword') }}">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-muted text-uppercase">Property Type</label>
                        <select name="type" class="form-select">
                            <option value="">Any Type</option>
                            <option value="buy" {{ request('type') == 'buy' ? 'selected' : '' }}>For Sale</option>
                            <option value="rent" {{ request('type') == 'rent' ? 'selected' : '' }}>For Rent</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted text-uppercase">Category</label>
                        <div class="category-list" style="max-height: 200px; overflow-y: auto;">
                            @foreach($categories as $cat)
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $cat->id }}" id="cat{{ $cat->id }}" {{ is_array(request('categories')) && in_array($cat->id, request('categories')) ? 'checked' : '' }}>
                                    <label class="form-check-label small" for="cat{{ $cat->id }}">
                                        {{ $cat->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                    <a href="{{ route('properties.index') }}" class="btn btn-link w-100 text-decoration-none mt-2 small">Reset All</a>
                </form>
            </div>
        </div>

        <!-- Property Grid -->
        <div class="col-lg-9">
            <div class="row g-4">
                @forelse($properties as $property)
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm overflow-hidden">
                        <div class="position-relative">
                            @if($property->images->count() > 0)
                                <img src="{{ asset('storage/' . $property->images->first()->image_path) }}" class="card-img-top" alt="{{ $property->title }}" style="height: 200px; object-fit: cover;">
                            @else
                                <img src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=500&q=80" class="card-img-top" alt="Default" style="height: 200px; object-fit: cover;">
                            @endif
                            <div class="position-absolute top-0 end-0 m-3 px-3 py-1 bg-white bg-opacity-90 rounded-pill shadow-sm">
                                <span class="fw-bold text-primary">${{ number_format($property->price) }}</span>
                            </div>
                            <div class="position-absolute bottom-0 start-0 m-3">
                                <span class="badge {{ $property->type == 'buy' ? 'bg-primary' : 'bg-success' }} px-3 py-1 rounded-pill shadow">
                                    {{ $property->type == 'buy' ? 'For Sale' : 'For Rent' }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body p-4 text-start">
                            <small class="text-primary fw-bold text-uppercase mb-1 d-inline-block">{{ $property->category->name }}</small>
                            <h5 class="card-title fw-bold mb-2"><a href="{{ route('properties.show', $property->id) }}" class="text-decoration-none text-dark">{{ $property->title }}</a></h5>
                            <p class="text-muted small mb-3"><i class="bi bi-geo-alt me-1"></i> {{ $property->location }}</p>
                            
                            <div class="d-flex justify-content-between border-top pt-3">
                                <div class="text-muted small">
                                    <i class="bi bi-door-open me-1"></i> {{ $property->beds }} Bds
                                </div>
                                <div class="text-muted small">
                                    <i class="bi bi-droplet me-1"></i> {{ $property->baths }} Bths
                                </div>
                                <div class="text-muted small">
                                    <i class="bi bi-bounding-box me-1"></i> {{ $property->area }} sqft
                                </div>
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

            <!-- Pagination -->
            <div class="mt-5 d-flex justify-content-center">
                {{ $properties->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
