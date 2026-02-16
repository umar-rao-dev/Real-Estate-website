@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('properties.index') }}">Properties</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $property->title }}</li>
        </ol>
    </nav>

    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Property Title & Location -->
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h1 class="fw-bold fs-2 mb-0">{{ $property->title }}</h1>
                    <div class="text-end">
                        <div class="h3 fw-bold text-primary mb-0">${{ number_format($property->price) }}</div>
                        <span class="badge {{ $property->type == 'buy' ? 'bg-primary' : 'bg-success' }}">For {{ ucfirst($property->type) }}</span>
                    </div>
                </div>
                <p class="text-muted"><i class="bi bi-geo-alt-fill me-1 text-primary"></i> {{ $property->location }}</p>
            </div>

            <!-- Image Gallery -->
            <div class="card border-0 shadow-sm overflow-hidden mb-4">
                <div id="propertyGallery" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @forelse($property->images as $index => $image)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $image->image_path) }}" class="d-block w-100" style="height: 500px; object-fit: cover;" alt="...">
                        </div>
                        @empty
                        <div class="carousel-item active">
                            <img src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=1200" class="d-block w-100" style="height: 500px; object-fit: cover;" alt="Default Image">
                        </div>
                        @endforelse
                    </div>
                    @if($property->images->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#propertyGallery" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#propertyGallery" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                    @endif
                </div>
                <!-- Thumbnails -->
                <div class="p-3 bg-white d-flex gap-2 overflow-auto">
                    @foreach($property->images as $index => $image)
                    <img src="{{ asset('storage/' . $image->image_path) }}" 
                         class="rounded cursor-pointer border" 
                         style="width: 80px; height: 60px; object-fit: cover;" 
                         data-bs-target="#propertyGallery" 
                         data-bs-slide-to="{{ $index }}">
                    @endforeach
                </div>
            </div>

            <!-- Property Overview -->
            <div class="card border-0 shadow-sm p-4 mb-4">
                <h5 class="fw-bold mb-4">Property Overview</h5>
                <div class="row g-4">
                    <div class="col-6 col-md-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                                <i class="bi bi-door-open fs-4 text-primary"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Bedrooms</small>
                                <span class="fw-bold">{{ $property->beds }} Bds</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                                <i class="bi bi-droplet fs-4 text-primary"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Bathrooms</small>
                                <span class="fw-bold">{{ $property->baths }} Bths</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                                <i class="bi bi-bounding-box fs-4 text-primary"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Area</small>
                                <span class="fw-bold">{{ $property->area }} sqft</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                                <i class="bi bi-tag fs-4 text-primary"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Category</small>
                                <span class="fw-bold text-truncate d-inline-block" style="max-width: 100px;">{{ $property->category->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="card border-0 shadow-sm p-4 mb-4">
                <h5 class="fw-bold mb-3">Description</h5>
                <div class="text-muted" style="line-height: 1.8;">
                    {!! nl2br(e($property->description)) !!}
                </div>
            </div>
        </div>

        <!-- Sidebar / Contact Agent -->
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 100px; z-index: 10;">
                <!-- Agent Info -->
                <div class="card border-0 shadow-sm p-4 mb-4">
                    <h5 class="fw-bold mb-4">Listed By</h5>
                    <div class="d-flex align-items-center mb-4">
                        @if($property->user->profile_image)
                            <img src="{{ asset('storage/' . $property->user->profile_image) }}" class="rounded-circle me-3" style="width: 60px; height: 60px; object-fit: cover;">
                        @else
                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                <i class="bi bi-person text-primary fs-3"></i>
                            </div>
                        @endif
                        <div>
                            <h6 class="fw-bold mb-0">{{ $property->user->name }}</h6>
                            <small class="text-muted">Real Estate Agent</small>
                        </div>
                    </div>
                    
                    @if(session('success'))
                        <div class="alert alert-success small p-2 mb-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Contact Form -->
                    <form action="{{ route('user.queries.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="property_id" value="{{ $property->id }}">
                        <input type="hidden" name="agent_id" value="{{ $property->user->id }}">
                        
                        @guest
                            <div class="alert alert-light border small text-center mb-3">
                                Please <a href="{{ route('login') }}" class="text-primary fw-bold">Login</a> to contact the agent.
                            </div>
                            <button type="button" class="btn btn-primary w-100 disabled">Send Message</button>
                        @else
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Message</label>
                                <textarea name="message" class="form-control" rows="4" placeholder="I'm interested in this property..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2">
                                <i class="bi bi-envelope me-2"></i> Contact Agent
                            </button>
                        @endguest
                    </form>
                </div>

                <!-- Safety Tip -->
                <div class="bg-warning bg-opacity-10 border border-warning rounded-4 p-4">
                    <h6 class="fw-bold text-warning-emphasis mb-2"><i class="bi bi-shield-check me-2"></i> Safety Tips</h6>
                    <ul class="small text-warning-emphasis mb-0 ps-3">
                        <li>Never pay in advance before seeing the property.</li>
                        <li>Always meet the agent in public places.</li>
                        <li>Verify documents before making any commitments.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
