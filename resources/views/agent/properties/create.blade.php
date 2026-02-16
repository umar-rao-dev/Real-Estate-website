@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">List New Property</h5>
                    <small class="text-muted">Properties will be visible after admin approval.</small>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('agent.properties.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
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
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <h6 class="text-primary mb-3">Settings</h6>
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select class="form-select" id="category_id" name="category_id" required>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price ($)</label>
                                    <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                                </div>
                                <div class="mb-3">
                                    <label for="type" class="form-label">Type</label>
                                    <select class="form-select" id="type" name="type" required>
                                        <option value="buy">For Sale</option>
                                        <option value="rent">For Rent</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="beds" class="form-label">Bedrooms</label>
                                <input type="number" class="form-control" id="beds" name="beds" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="baths" class="form-label">Bathrooms</label>
                                <input type="number" class="form-control" id="baths" name="baths" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="area" class="form-label">Area (sqft)</label>
                                <input type="number" step="0.1" class="form-control" id="area" name="area" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" id="location" name="location" required placeholder="City, State">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="images" class="form-label">Property Images</label>
                            <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
                            <small class="text-muted">You can select multiple images.</small>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('agent.properties.index') }}" class="btn btn-light me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4">Submit Property</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
