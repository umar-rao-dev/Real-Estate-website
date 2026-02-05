@extends('layouts.user')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">My Profile</h1>

    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required>
        </div>

        <div class="mb-3">
            <label>Password (leave blank to keep current)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Photo</label>
            <input type="file" name="photo" class="form-control" accept="image/*">
            @if(auth()->user()->photo)
            <img src="{{ asset('storage/'.auth()->user()->photo) }}" class="img-thumbnail mt-2" width="150">
            @endif
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="theme" class="form-check-input" value="dark" {{ auth()->user()->theme == 'dark' ? 'checked' : '' }}>
            <label class="form-check-label">Dark Mode</label>
        </div>

        <button type="submit" class="btn btn-success">Update Profile</button>
    </form>
</div>
@endsection
