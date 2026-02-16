@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row items-center justify-content-center">
        <div class="col-lg-10">
            <h2 class="fw-bold mb-4">Account Settings</h2>
            
            <div class="row g-4">
                <!-- Profile Card -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm text-center p-4">
                        <div class="mb-3 position-relative d-inline-block mx-auto">
                            @if(auth()->user()->profile_image)
                                <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" class="rounded-circle shadow-sm" style="width: 120px; height: 120px; object-fit: cover;">
                            @else
                                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm" style="width: 120px; height: 120px;">
                                    <i class="bi bi-person fs-1 text-primary"></i>
                                </div>
                            @endif
                        </div>
                        <h5 class="fw-bold mb-1">{{ auth()->user()->name }}</h5>
                        <p class="text-muted small mb-3">{{ auth()->user()->email }}</p>
                        <span class="badge bg-primary px-3 rounded-pill">{{ ucfirst(auth()->user()->role) }}</span>
                        
                        <hr class="my-4">
                        
                        <div class="text-start small text-muted">
                            <p class="mb-1"><i class="bi bi-calendar-check me-2"></i> Joined {{ auth()->user()->created_at->format('M Y') }}</p>
                            <p class="mb-0"><i class="bi bi-shield-lock me-2"></i> Role: {{ ucfirst(auth()->user()->role) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Settings Form -->
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm p-4">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <h6 class="fw-bold mb-3 text-uppercase small text-primary">Personal Details</h6>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Full Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Email Address</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label small fw-bold">Profile Image</label>
                                    <input type="file" name="profile_image" class="form-control" accept="image/*">
                                </div>
                            </div>

                            <h6 class="fw-bold mb-3 text-uppercase small text-primary">Preference</h6>
                            <div class="mb-4">
                                <label class="form-label small fw-bold">Theme Mode</label>
                                <div class="d-flex gap-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="theme" id="themeLight" value="light" {{ auth()->user()->theme == 'light' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="themeLight">Light Mode</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="theme" id="themeDark" value="dark" {{ auth()->user()->theme == 'dark' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="themeDark">Dark Mode</label>
                                    </div>
                                </div>
                            </div>

                            <h6 class="fw-bold mb-3 text-uppercase small text-primary">Security</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">New Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Leave empty to keep current">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>
                            </div>

                            <hr class="my-4">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary px-5 py-2">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
