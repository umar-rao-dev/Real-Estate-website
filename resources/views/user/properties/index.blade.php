@extends('layouts.user')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">All Properties</h1>

    <div class="row">
        @foreach($properties as $property)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card">
                <img src="{{ asset('storage/'.$property->main_image) }}" class="card-img-top" alt="Property">
                <div class="card-body">
                    <h5 class="card-title">{{ $property->title }}</h5>
                    <p class="card-text">{{ Str::limit($property->description, 60) }}</p>
                    <p class="text-muted">{{ $property->price }} USD</p>
                    <a href="{{ route('user.properties.show', $property->id) }}" class="btn btn-primary btn-sm">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
