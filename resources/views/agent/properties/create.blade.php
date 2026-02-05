@extends('layouts.agent')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Add Property</h1>

    <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-select" required>
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Location</label>
            <input type="text" name="location" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="available">Available</option>
                <option value="sold">Sold</option>
                <option value="rented">Rented</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Main Image</label>
            <input type="file" name="main_image" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label>Additional Images</label>
            <input type="file" name="images[]" class="form-control" multiple accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Save Property</button>
    </form>
</div>
@endsection
