@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 mb-4">
            <!-- Profile Info Sidebar -->
            <div class="card border-0 shadow-sm text-center p-4">
                <div class="mb-3">
                    @if($user->profile_image)
                        <img src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->name }}" class="rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto shadow" style="width: 150px; height: 150px;">
                            <i class="bi bi-person fs-1 text-primary"></i>
                        </div>
                    @endif
                </div>
                <h4 class="mb-1">{{ $user->name }}</h4>
                <p class="text-muted mb-3">{{ ucfirst($user->role) }}</p>
                <div class="badge bg-primary px-3 py-2 mb-3">Administrator</div>
                <hr>
                <div class="text-start px-3">
                    <p class="mb-2"><strong>Email:</strong> {{ $user->email }}</p>
                    <p class="mb-2"><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</p>
                    <p class="mb-0"><strong>Member Since:</strong> {{ $user->created_at->format('M Y') }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Edit Profile</h5>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="profile_image" class="form-label">Update Profile Image</label>
                                <input type="file" class="form-control @error('profile_image') is-invalid @enderror" id="profile_image" name="profile_image" accept="image/*">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="theme" class="form-label">Preferred Theme</label>
                                <select class="form-select @error('theme') is-invalid @enderror" id="theme" name="theme">
                                    <option value="light" {{ $user->theme == 'light' ? 'selected' : '' }}>Light Mode</option>
                                    <option value="dark" {{ $user->theme == 'dark' ? 'selected' : '' }}>Dark Mode</option>
                                </select>
                            </div>
                        </div>

                        <hr class="my-4">
                        <h6 class="mb-3">Change Password <small class="text-muted">(Leave blank to keep current)</small></h6>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
