@extends('layouts.app')

@section('content')
<div class="py-5 bg-white border-bottom">
    <div class="container text-center py-4">
        <h1 class="display-4 fw-800 mb-3 animate-up">News & Announcements</h1>
        <p class="lead text-muted animate-up">Stay updated with the latest platform features and market trends.</p>
    </div>
</div>

<div class="container py-5 mt-n5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="row g-4">
                @forelse($announcements as $ann)
                <div class="col-12 animate-up">
                    <div class="card border-0 shadow-lg p-2 rounded-4 overflow-hidden">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                    <i class="bi bi-megaphone-fill fs-4"></i>
                                </div>
                                <div>
                                    <span class="badge-soft badge-primary-soft mb-1 d-inline-block">{{ $ann->created_at->format('l, M d, Y') }}</span>
                                    <h3 class="fw-800 h4 mb-0">{{ $ann->title }}</h3>
                                </div>
                            </div>
                            <p class="text-muted fs-5 lh-lg mb-0" style="white-space: pre-wrap;">{{ $ann->description }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <div class="opacity-25 mb-4"><i class="bi bi-info-circle display-1"></i></div>
                    <h3 class="fw-800">Everything is Quiet</h3>
                    <p class="text-muted">There are no new announcements at the moment. Check back later!</p>
                    <a href="{{ route('home') }}" class="btn btn-premium mt-3">Return Home</a>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .mt-n5 { margin-top: -3rem !important; }
</style>
@endsection
