@extends('layouts.app')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('properties.index') }}">Properties</a></li>
            <li class="breadcrumb-item active">{{ $property->name }}</li>
        </ol>
    </nav>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-start">
                    <h1 class="fw-bold mb-0">{{ $property->name }}</h1>
                    <div class="text-end">
                        <div class="h3 fw-bold text-primary mb-0">${{ number_format($property->price) }}</div>
                        <span class="badge {{ $property->type == 'buy' ? 'bg-primary' : 'bg-success' }}">For {{ ucfirst($property->type) }}</span>
                    </div>
                </div>
                <p class="text-muted"><i class="bi bi-geo-alt-fill text-primary"></i> {{ $property->location }}</p>
            </div>

            <div class="card border-0 shadow-sm overflow-hidden mb-4">
                <div id="propertyGallery" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @forelse($property->images as $index => $image)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $image->image_path) }}" class="d-block w-100" style="height: 500px; object-fit: cover;">
                        </div>
                        @empty
                        <div class="carousel-item active">
                            <img src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=1200" class="d-block w-100" style="height: 500px; object-fit: cover;">
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm p-4 mb-4">
                <h5 class="fw-bold mb-4">Property Overview</h5>
                <div class="row text-center g-4">
                    <div class="col-3">
                        <i class="bi bi-door-open fs-3 text-primary d-block mb-1"></i>
                        <small class="text-muted">Beds</small>
                        <div class="fw-bold">{{ $property->beds }}</div>
                    </div>
                    <div class="col-3">
                        <i class="bi bi-droplet fs-3 text-primary d-block mb-1"></i>
                        <small class="text-muted">Baths</small>
                        <div class="fw-bold">{{ $property->baths }}</div>
                    </div>
                    <div class="col-3">
                        <i class="bi bi-bounding-box fs-3 text-primary d-block mb-1"></i>
                        <small class="text-muted">Area</small>
                        <div class="fw-bold">{{ $property->area }} sqft</div>
                    </div>
                    <div class="col-3">
                        <i class="bi bi-tag fs-3 text-primary d-block mb-1"></i>
                        <small class="text-muted">Category</small>
                        <div class="fw-bold text-truncate">{{ $property->category->name }}</div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm p-4 mb-4">
                <h5 class="fw-bold mb-3">Description</h5>
                <p class="text-muted" style="line-height: 1.8;">{!! nl2br(e($property->description)) !!}</p>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="sticky-top" style="top: 100px;">
                <div class="card border-0 shadow-sm p-4 mb-4">
                    <h5 class="fw-bold mb-4">Interested?</h5>
                    
                    @if(session('success'))
                        <div class="alert alert-success small mb-3">{{ session('success') }}</div>
                    @endif

                    @auth
                        @if($property->type == 'buy' && $property->availability == 'available')
                            <form action="{{ route('user.orders.store') }}" method="POST" class="mb-3">
                                @csrf
                                <input type="hidden" name="property_id" value="{{ $property->id }}">
                                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                                    <i class="bi bi-cart-fill me-2"></i> BUY NOW
                                </button>
                            </form>
                        @endif

                        <hr>

                        <form action="{{ route('user.queries.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="property_id" value="{{ $property->id }}">
                            <div class="mb-3">
                                <label class="small fw-bold">Message Agent</label>
                                <textarea name="message" class="form-control" rows="3" placeholder="Ask a question..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-outline-primary w-100">Contact Agent</button>
                        </form>
                    @else
                        <div class="alert alert-light border text-center">
                            Please <a href="{{ route('login') }}" class="fw-bold">Login</a> to buy or contact the agent.
                        </div>
                    @endauth
                </div>

                <div class="card border-0 shadow-sm p-4">
                    <h5 class="fw-bold mb-3">Agent Info</h5>
                    <div class="d-flex align-items-center">
                        @if($property->user->photo)
                            <img src="{{ asset('storage/' . $property->user->photo) }}" class="rounded-circle me-3" style="width: 50px; height: 500px; object-fit: cover;">
                        @else
                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="bi bi-person text-primary"></i>
                            </div>
                        @endif
                        <div>
                            <div class="fw-bold">{{ $property->user->name }}</div>
                            <small class="text-muted">Real Estate Agent</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
