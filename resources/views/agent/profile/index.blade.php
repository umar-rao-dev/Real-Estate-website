@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm text-center p-4">
                <div class="mb-3">
                    @if($user->profile_image)
                        <img src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->name }}" class="rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto shadow" style="width: 150px; height: 150px;">
                            <i class="bi bi-person fs-1 text-success"></i>
                        </div>
                    @endif
                </div>
                <h4 class="mb-1">{{ $user->name }}</h4>
                <div class="badge bg-success px-3 py-2 mb-3">Verified Agent</div>
                <p class="text-muted small">Helping people find their dream homes since {{ $user->created_at->format('Y') }}.</p>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Agent Profile Settings</h5>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('agent.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Profile Image</label>
                                <input type="file" class="form-control" name="profile_image" accept="image/*">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Theme</label>
                                <select class="form-select" name="theme">
                                    <option value="light" {{ $user->theme == 'light' ? 'selected' : '' }}>Light</option>
                                    <option value="dark" {{ $user->theme == 'dark' ? 'selected' : '' }}>Dark</option>
                                </select>
                            </div>
                        </div>

                        <hr class="my-4">
                        <h6 class="mb-3">Security</h6>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">New Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Leave blank to keep current">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success px-4">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
