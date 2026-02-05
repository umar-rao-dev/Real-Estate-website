@extends('layouts.user')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Welcome, {{ auth()->user()->name }}</h1>

    <div class="row mb-4">
        <div class="col-md-8">
            <form action="{{ route('user.properties.search') }}" method="GET" class="d-flex mb-3">
                <input type="text" name="keyword" class="form-control me-2" placeholder="Search properties...">
                <select name="type" class="form-select me-2">
                    <option value="">Any Type</option>
                    <option value="buy">Buy</option>
                    <option value="rent">Rent</option>
                </select>
                <button class="btn btn-primary">Search</button>
            </form>

            <h4>Featured Properties</h4>
            <div class="row">
                @foreach($featured_properties as $property)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage/'.$property->main_image) }}" class="card-img-top" alt="Property">
                        <div class="card-body">
                            <h5 class="card-title">{{ $property->title }}</h5>
                            <p class="card-text">{{ Str::limit($property->description, 50) }}</p>
                            <p class="text-muted">{{ $property->price }} USD</p>
                            <a href="{{ route('user.properties.show', $property->id) }}" class="btn btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3">
                <h5>Become an Agent</h5>
                <form action="{{ route('user.become_agent') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <textarea name="message" class="form-control" placeholder="Write a message..." required></textarea>
                    </div>
                    <button class="btn btn-success w-100">Send Request</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
