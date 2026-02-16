@extends('layouts.app')

@section('content')
<div class="hero-section py-5">
    <div class="container text-center py-4">
        <h1 class="fw-bold mb-0 text-white">My Profile Settings</h1>
        <p class="lead text-white-50">Manage your personal information and account security.</p>
    </div>
</div>

<div class="container py-5 mt-n5">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow text-center p-4">
                <div class="mb-3">
                    @if($user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}" class="rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto shadow" style="width: 150px; height: 150px;">
                            <i class="bi bi-person fs-1 text-primary"></i>
                        </div>
                    @endif
                </div>
                <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                <p class="text-muted">{{ $user->email }}</p>
                <div class="badge bg-primary px-3 py-2 rounded-pill mb-3">Valued User</div>
                <hr>
                <p class="text-muted small mb-0">Joined on {{ $user->created_at->format('M d, Y') }}</p>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card border-0 shadow">
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <h5 class="fw-bold mb-3 border-bottom pb-2">Personal Information</h5>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Full Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Email Address</label>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Profile Photo</label>
                                <input type="file" class="form-control" name="photo" accept="image/*">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Preferred Theme</label>
                                <select class="form-select" name="theme">
                                    <option value="light" {{ $user->theme == 'light' ? 'selected' : '' }}>Light</option>
                                    <option value="dark" {{ $user->theme == 'dark' ? 'selected' : '' }}>Dark</option>
                                </select>
                            </div>
                            
                            <div class="col-md-12 mt-4">
                                <h5 class="fw-bold mb-3 border-bottom pb-2">Security</h5>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small">New Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Leave blank to skip">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small">Confirm New Password</label>
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>

                            <div class="col-md-12 text-end mt-4">
                                <button type="submit" class="btn btn-primary px-5 rounded-pill fw-bold">Update Account</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
