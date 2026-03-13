@extends('layouts.app')

@section('content')
<div class="py-5 bg-light">
    <div class="container py-4">
        <!-- Navigation & Status -->
        <div class="d-flex justify-content-between align-items-center mb-4 animate-up">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('properties.index') }}" class="text-decoration-none text-muted">Properties</a></li>
                    <li class="breadcrumb-item active fw-bold" aria-current="page">{{ $property->name }}</li>
                </ol>
            </nav>
            <div class="d-flex gap-2">
                <span class="badge-soft badge-primary-soft">{{ $property->category->name }}</span>
                <span class="badge {{ $property->availability == 'available' ? 'bg-success' : 'bg-danger' }} rounded-pill px-3">{{ ucfirst($property->availability) }}</span>
            </div>
        </div>

        <div class="row g-5">
            <!-- Left Side: Gallery & Info -->
            <div class="col-lg-8 animate-up">
                <!-- Gallery -->
                <div class="card p-0 mb-5 border-0 shadow-lg overflow-hidden">
                    <div id="propertyGallery" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @forelse($property->images as $index => $img)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $img->image_path) }}" class="d-block w-100" style="height: 500px; object-fit: cover;" alt="Property Image">
                                </div>
                            @empty
                                <div class="carousel-item active">
                                    <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=1200&q=80" class="d-block w-100" style="height: 500px; object-fit: cover;" alt="Default Image">
                                </div>
                            @endforelse
                        </div>
                        @if($property->images->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#propertyGallery" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon shadow" aria-hidden="true"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#propertyGallery" data-bs-slide="next">
                            <span class="carousel-control-next-icon shadow" aria-hidden="true"></span>
                        </button>
                        @endif
                    </div>
                </div>

                <!-- Basic Info -->
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h1 class="fw-800 display-5 mb-2">{{ $property->name }}</h1>
                        <p class="text-muted fs-5"><i class="bi bi-geo-alt-fill text-primary me-2"></i>{{ $property->location }}</p>
                    </div>
                    <div class="text-end">
                        <h2 class="fw-800 text-primary display-6">${{ number_format($property->price) }}</h2>
                        <span class="text-muted">For {{ ucfirst($property->type) }}</span>
                    </div>
                </div>

                <!-- Key Stats -->
                <div class="row g-4 mb-5">
                    <div class="col-md-3 col-6">
                        <div class="card p-3 text-center border-0 bg-white">
                            <i class="bi bi-door-open fs-2 text-primary mb-2"></i>
                            <div class="fw-800 fs-5">{{ $property->beds }}</div>
                            <div class="text-muted small">Bedrooms</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="card p-3 text-center border-0 bg-white">
                            <i class="bi bi-water fs-2 text-primary mb-2"></i>
                            <div class="fw-800 fs-5">{{ $property->baths }}</div>
                            <div class="text-muted small">Bathrooms</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="card p-3 text-center border-0 bg-white">
                            <i class="bi bi-aspect-ratio fs-2 text-primary mb-2"></i>
                            <div class="fw-800 fs-5">{{ $property->area }}</div>
                            <div class="text-muted small">Sq Ft Area</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="card p-3 text-center border-0 bg-white">
                            <i class="bi bi-calendar-check fs-2 text-primary mb-2"></i>
                            <div class="fw-800 fs-5">{{ $property->created_at->format('Y') }}</div>
                            <div class="text-muted small">Listed Year</div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-5">
                    <h4 class="fw-800 mb-4 border-bottom pb-3">About this Property</h4>
                    <p class="text-muted lh-lg fs-5">{{ $property->description }}</p>
                </div>
            </div>

            <!-- Right Side: Agent & Contact -->
            <div class="col-lg-4 animate-up" style="animation-delay: 0.2s;">
                <div class="sticky-top" style="top: 100px; z-index: 10;">
                    <!-- Agent Info -->
                    <div class="card p-4 mb-4 border-0">
                        <h5 class="fw-800 mb-4">Listing Agent</h5>
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 600x; min-width: 60px; min-height: 60px; font-size: 1.5rem; font-weight: 800;">
                                {{ substr($property->user->name, 0, 1) }}
                            </div>
                            <div>
                                <h6 class="fw-800 mb-1">{{ $property->user->name }}</h6>
                                <p class="text-muted small mb-0"><i class="bi bi-envelope me-1"></i> {{ $property->user->email }}</p>
                            </div>
                        </div>
                        <a href="#" class="btn btn-outline-primary w-100 rounded-3 fw-bold">View Agent Profile</a>
                    </div>

                    <!-- Buy Now Action -->
                    @if($property->availability == 'available' && $property->type == 'buy')
                    <div class="card p-4 border-0 mb-4" style="background: var(--gradient); border: none;">
                        <h5 class="fw-800 text-white mb-3 text-center">Interested in Buying?</h5>
                        <form action="{{ route('user.orders.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="property_id" value="{{ $property->id }}">
                            <button type="submit" class="btn btn-white w-100 py-3 shadow-sm rounded-3 fw-800">
                                <i class="bi bi-cart-fill me-2"></i> BUY NOW
                            </button>
                        </form>
                        <p class="text-center text-white-50 small mt-3 mb-0">Secured transaction powered by RealEstate</p>
                    </div>
                    @endif

                    <!-- Contact Form -->
                    <div class="card p-4 border-0">
                        <h5 class="fw-800 mb-4">Contact Agent</h5>
                        @if(session('success_query'))
                            <div class="alert alert-success border-0 small mb-4">{{ session('success_query') }}</div>
                        @endif
                        <form action="{{ route('user.queries.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="property_id" value="{{ $property->id }}">
                            <div class="mb-3">
                                <textarea name="message" class="form-control bg-light border-0 p-3" rows="4" placeholder="I'm interested in this property. Can we schedule a call?" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-premium w-100 py-3 rounded-3 shadow-sm">Send Inquiry</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .fw-800 { font-weight: 800; }
    .breadcrumb-item + .breadcrumb-item::before { content: "›"; font-size: 1.2rem; line-height: 1; }
    .carousel-item img { border-radius: 0; }
    .sticky-top { transition: top 0.3s; }
</style>
@endsection
