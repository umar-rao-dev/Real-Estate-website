@extends('layouts.agent')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Edit Property</h1>

    <form action="{{ route('properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $property->title }}" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4" required>{{ $property->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-select" required>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ $property->category_id == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" class="form-control" value="{{ $property->price }}" required>
        </div>

        <div class="mb-3">
            <label>Location</label>
            <input type="text" name="location" class="form-control" value="{{ $property->location }}" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="available" {{ $property->status == 'available' ? 'selected' : '' }}>Available</option>
                <option value="sold" {{ $property->status == 'sold' ? 'selected' : '' }}>Sold</option>
                <option value="rented" {{ $property->status == 'rented' ? 'selected' : '' }}>Rented</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Main Image</label>
            <input type="file" name="main_image" class="form-control" accept="image/*">
            @if($property->main_image)
            <img src="{{ asset('storage/'.$property->main_image) }}" class="img-thumbnail mt-2" width="150">
            @endif
        </div>

        <div class="mb-3">
            <label>Additional Images</label>
            <input type="file" name="images[]" class="form-control" multiple accept="image/*">
            <div class="mt-2">
                @foreach($property->images as $img)
                <img src="{{ asset('storage/'.$img->image_path) }}" class="img-thumbnail me-2 mb-2" width="100">
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-success">Update Property</button>
    </form>
</div>
@endsection
    