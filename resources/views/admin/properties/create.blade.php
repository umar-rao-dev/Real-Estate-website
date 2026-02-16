@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Add New Property</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.properties.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <!-- Basic Info -->
                            <div class="col-md-8 mb-4">
                                <h6 class="text-primary mb-3">Basic Information</h6>
                                <div class="mb-3">
                                    <label for="title" class="form-label">Property Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                           id="title" name="title" value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" name="description" rows="6" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Category & Pricing -->
                            <div class="col-md-4 mb-4">
                                <h6 class="text-primary mb-3">Category & Pricing</h6>
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="price" class="form-label">Price ($)</label>
                                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                                           id="price" name="price" value="{{ old('price') }}" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="type" class="form-label">Type</label>
                                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                        <option value="buy" {{ old('type') == 'buy' ? 'selected' : '' }}>For Sale</option>
                                        <option value="rent" {{ old('type') == 'rent' ? 'selected' : '' }}>For Rent</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <hr>

                            <!-- Details -->
                            <div class="col-md-12 mb-4">
                                <h6 class="text-primary mb-3">Property Details</h6>
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label for="beds" class="form-label">Bedrooms</label>
                                        <input type="number" class="form-control @error('beds') is-invalid @enderror" 
                                               id="beds" name="beds" value="{{ old('beds') }}" required>
                                        @error('beds')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="baths" class="form-label">Bathrooms</label>
                                        <input type="number" class="form-control @error('baths') is-invalid @enderror" 
                                               id="baths" name="baths" value="{{ old('baths') }}" required>
                                        @error('baths')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="area" class="form-label">Area (sqft)</label>
                                        <input type="number" step="0.01" class="form-control @error('area') is-invalid @enderror" 
                                               id="area" name="area" value="{{ old('area') }}" required>
                                        @error('area')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="location" class="form-label">Location</label>
                                        <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                               id="location" name="location" value="{{ old('location') }}" required>
                                        @error('location')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- Media & Status -->
                            <div class="col-md-12 mb-4">
                                <h6 class="text-primary mb-3">Media & Visibility</h6>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="images" class="form-label">Property Images (Select multiple)</label>
                                        <input type="file" class="form-control @error('images') is-invalid @enderror" 
                                               id="images" name="images[]" multiple accept="image/*">
                                        @error('images')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="availability" class="form-label">Availability</label>
                                        <select class="form-select @error('availability') is-invalid @enderror" id="availability" name="availability" required>
                                            <option value="available" {{ old('availability') == 'available' ? 'selected' : '' }}>Available</option>
                                            <option value="sold" {{ old('availability') == 'sold' ? 'selected' : '' }}>Sold/Rented</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3 d-flex align-items-end">
                                        <div class="form-check mb-2">
                                            <input type="checkbox" class="form-check-input" id="is_approved" name="is_approved" value="1" checked>
                                            <label class="form-check-label" for="is_approved">Approve Immediately</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('admin.properties.index') }}" class="btn btn-light me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4">Create Property</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection