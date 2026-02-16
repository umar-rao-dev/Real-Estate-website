@extends('layouts.app')

@section('content')
<div class="hero-section text-center">
    <div class="container">
        <h1 class="display-4 fw-bold">Contact Us</h1>
        <p class="lead">Have questions? We're here to help you find your dream home.</p>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm p-4">
                @if(session('success'))
                    <div class="alert alert-success border-0 shadow-sm mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="What is this regarding?" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Message</label>
                        <textarea name="message" class="form-control" rows="5" placeholder="Your message here..." required></textarea>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-5 py-2">
                            <i class="bi bi-send me-2"></i> Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
