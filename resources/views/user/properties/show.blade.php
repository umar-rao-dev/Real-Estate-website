@extends('layouts.user')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">{{ $property->title }}</h1>

    <div class="row">
        <div class="col-md-8">
            <div id="carouselImages" class="carousel slide mb-4" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('storage/'.$property->main_image) }}" class="d-block w-100" alt="Main Image">
                    </div>
                    @foreach($property->images as $img)
                    <div class="carousel-item">
                        <img src="{{ asset('storage/'.$img->image_path) }}" class="d-block w-100" alt="Additional Image">
                    </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselImages" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>

            <h5>Description</h5>
            <p>{{ $property->description }}</p>

            <h5>Details</h5>
            <ul>
                <li>Price: {{ $property->price }} USD</li>
                <li>Beds: {{ $property->beds ?? '-' }}</li>
                <li>Baths: {{ $property->baths ?? '-' }}</li>
                <li>Area: {{ $property->area ?? '-' }} sq ft</li>
                <li>Location: {{ $property->location }}</li>
                <li>Status: {{ ucfirst($property->status) }}</li>
            </ul>
        </div>

        <div class="col-md-4">
            <div class="card p-3">
                <h5>Contact Agent</h5>
                <form action="{{ route('user.queries.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="property_id" value="{{ $property->id }}">
                    <div class="mb-3">
                        <textarea name="message" class="form-control" placeholder="Write a message..." required></textarea>
                    </div>
                    <button class="btn btn-primary w-100">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
