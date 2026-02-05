@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Edit Category</h1>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $category->description }}</textarea>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" class="form-check-input" {{ $category->is_active ? 'checked' : '' }}>
            <label class="form-check-label">Active</label>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
