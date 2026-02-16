@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Edit Property: {{ $property->title }}</h5>
                    @if(!$property->is_approved)
                        <span class="badge bg-warning text-dark mt-2">Still Pending Admin Approval</span>
                    @endif
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('agent.properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-8 mb-4">
                                <h6 class="text-primary mb-3">Basic Information</h6>
                                <div class="mb-3">
                                    <label for="title" class="form-label">Property Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                           id="title" name="title" value="{{ old('title', $property->title) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="6" required>{{ old('description', $property->description) }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <h6 class="text-primary mb-3">Settings</h6>
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select class="form-select" id="category_id" name="category_id" required>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $property->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price ($)</label>
                                    <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ $property->price }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="type" class="form-label">Type</label>
                                    <select class="form-select" id="type" name="type" required>
                                        <option value="buy" {{ $property->type == 'buy' ? 'selected' : '' }}>For Sale</option>
                                        <option value="rent" {{ $property->type == 'rent' ? 'selected' : '' }}>For Rent</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="availability" class="form-label">Availability</label>
                                    <select class="form-select" id="availability" name="availability" required>
                                        <option value="available" {{ $property->availability == 'available' ? 'selected' : '' }}>Available</option>
                                        <option value="sold" {{ $property->availability == 'sold' ? 'selected' : '' }}>Sold/Rented</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="beds" class="form-label">Bedrooms</label>
                                <input type="number" class="form-control" id="beds" name="beds" value="{{ $property->beds }}" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="baths" class="form-label">Bathrooms</label>
                                <input type="number" class="form-control" id="baths" name="baths" value="{{ $property->baths }}" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="area" class="form-label">Area (sqft)</label>
                                <input type="number" step="0.1" class="form-control" id="area" name="area" value="{{ $property->area }}" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" id="location" name="location" value="{{ $property->location }}" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('agent.properties.index') }}" class="btn btn-light me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4">Update Property</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection