@extends('layouts.app')

@section('content')
<!-- Hero Section / Landing Page Header -->
<section class="hero text-white">
    <div class="container position-relative z-1">
        <div class="row align-items-center">
            <div class="col-lg-6 animate-up">
                @auth
                    <h1 class="display-3 fw-800 mb-4">Welcome Back, <br><span class="text-white opacity-75">{{ auth()->user()->name }}</span></h1>
                    <p class="lead mb-5 opacity-75">Ready to find your next investment or dream home? Check out the latest updates below.</p>
                @else
                    <h1 class="display-3 fw-800 mb-4">Find Your <span class="text-white opacity-75">Dream</span> Home with Confidence</h1>
                    <p class="lead mb-5 opacity-75">The most trusted marketplace for verified properties and elite agents. Start your journey today.</p>
                @endauth
                
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('properties.index') }}" class="btn btn-white px-5 shadow-sm">Explore Listings</a>
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-outline-light px-5" style="border-radius: 16px; border-width: 2.5px; font-weight: 700;">Join as Agent</a>
                    @endguest
                    @auth
                        <a href="{{ route(auth()->user()->role . '.dashboard') }}" class="btn btn-outline-light px-5" style="border-radius: 16px; border-width: 2.5px; font-weight: 700;">My Panel</a>
                    @endauth
                </div>
            </div>
            <div class="col-lg-5 ms-auto d-none d-lg-block animate-up">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1000&q=80" alt="Premium Villa" class="img-fluid rounded-4 shadow-lg border border-white border-4">
                    <div class="position-absolute bottom-0 start-0 m-4 bg-white p-3 rounded-4 shadow-lg d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 text-success rounded-circle p-2 me-3">
                            <i class="bi bi-patch-check-fill fs-4"></i>
                        </div>
                        <div>
                            <div class="fw-800 small">100% Verified</div>
                            <div class="text-muted extra-small" style="font-size: 0.7rem;">Direct Agent Listings</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Content Area -->
<div class="container py-5 mt-n5 position-relative z-1">
    <div class="row g-4 mb-5">
        <!-- Main Property Feed -->
        <div class="col-lg-8 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 animate-up">
                <div>
                    <h3 class="fw-800 mb-0">Featured Discoveries</h3>
                    <p class="text-muted small mb-0">Hand-picked premium properties for you</p>
                </div>
                <a href="{{ route('properties.index') }}" class="text-decoration-none fw-bold text-primary">Browse All <i class="bi bi-arrow-right ms-1"></i></a>
            </div>
            
            <div class="row g-4">
                @forelse($featuredProperties as $p)
                <div class="col-md-6 mb-4 animate-up">
                    <div class="card h-100 border-0">
                        <div class="position-relative overflow-hidden">
                            @if($p->images->count() > 0)
                                <img src="{{ asset('storage/' . $p->images->first()->image_path) }}" class="card-img-top" style="height: 260px; object-fit: cover;">
                            @else
                                <img src="https://images.unsplash.com/photo-1518780664697-55e3ad937233?auto=format&fit=crop&w=800&q=80" class="card-img-top" style="height: 260px; object-fit: cover;">
                            @endif
                            <div class="position-absolute top-0 end-0 m-3 d-flex flex-column gap-2">
                                <span class="badge bg-white text-primary fw-800 shadow-sm p-2 rounded-3 px-3">For {{ ucfirst($p->type) }}</span>
                                <span class="badge bg-primary text-white fw-800 shadow-sm p-2 rounded-3 px-3">${{ number_format($p->price) }}</span>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="text-primary small fw-800 text-uppercase mb-2" style="letter-spacing: 1px;">{{ $p->category->name }}</div>
                            <h5 class="fw-800 mb-3"><a href="{{ route('properties.show', $p->id) }}" class="text-decoration-none text-dark">{{ $p->name }}</a></h5>
                            <div class="text-muted small mb-4 d-flex align-items-center"><i class="bi bi-geo-alt-fill me-2 text-primary"></i> {{ $p->location }}</div>
                            
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                <div class="d-flex gap-4 text-muted small">
                                    <div class="d-flex align-items-center"><i class="bi bi-door-open me-2 text-primary"></i>{{ $p->beds }}</div>
                                    <div class="d-flex align-items-center"><i class="bi bi-water me-2 text-primary"></i>{{ $p->baths }}</div>
                                    <div class="d-flex align-items-center"><i class="bi bi-aspect-ratio me-2 text-primary"></i>{{ $p->area }} <span class="ms-1 d-none d-sm-inline">SqFt</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <div class="opacity-25 mb-3"><i class="bi bi-building fs-1"></i></div>
                    <p class="text-muted fw-bold">No featured properties available right now.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Right Side: Sidebar Features -->
        <div class="col-lg-4">
            <!-- Search Widget -->
            <div class="card p-4 mb-4 border-0">
                <h5 class="fw-800 mb-3">Quick Search</h5>
                <form action="{{ route('properties.index') }}" method="GET">
                    <div class="input-group mb-3 bg-light rounded-4 overflow-hidden p-1">
                        <span class="input-group-text bg-transparent border-0"><i class="bi bi-search"></i></span>
                        <input type="text" name="keyword" class="form-control bg-transparent border-0 py-2" placeholder="City, Area, Name...">
                    </div>
                    <button class="btn btn-premium w-100 rounded-4">Search Properties</button>
                </form>
            </div>

            <!-- Announcements / News -->
            <div class="card p-4 mb-4 border-0">
                <h5 class="fw-800 mb-4 d-flex justify-content-between align-items-center">
                    Latest Updates
                    <i class="bi bi-megaphone text-primary"></i>
                </h5>
                @forelse($announcements as $ann)
                <div class="mb-4 pb-3 border-bottom last-child-no-border">
                    <div class="badge bg-primary-soft text-primary mb-2" style="font-size: 0.65rem;">{{ $ann->created_at->format('M d') }}</div>
                    <h6 class="fw-bold mb-2">{{ $ann->title }}</h6>
                    <p class="text-muted small mb-0">{{ Str::limit($ann->description, 80) }}</p>
                </div>
                @empty
                <p class="text-muted small py-3">No new updates today.</p>
                @endforelse
                <a href="{{ route('user.announcements.index') }}" class="btn btn-light w-100 rounded-4 fw-bold mt-2">View News Center</a>
            </div>

            <!-- Agent CTA -->
            @auth
                @if(!auth()->user()->isAgent() && !auth()->user()->isAdmin())
                <div class="card p-4 text-white p-4 border-0 text-center" style="background: var(--gradient); border-radius: 28px;">
                    <div class="bg-white bg-opacity-20 rounded-circle d-inline-flex p-3 mb-4">
                        <i class="bi bi-award fs-2"></i>
                    </div>
                    <h4 class="fw-800 mb-3">Become an Agent</h4>
                    <p class="small opacity-75 mb-4">Start listing your own properties and access premium agent tools.</p>
                    <button class="btn btn-white w-100 py-3" data-bs-toggle="modal" data-bs-target="#becomeAgentModal">Apply Now</button>
                </div>
                @endif
            @else
                <div class="card p-4 text-white p-4 border-0 text-center" style="background: var(--gradient); border-radius: 28px;">
                    <h4 class="fw-800 mb-3">Ready to List?</h4>
                    <p class="small opacity-75 mb-4">Sign up today and join our network of professional real estate agents.</p>
                    <a href="{{ route('register') }}" class="btn btn-white w-100 py-3">Get Started</a>
                </div>
            @endauth
        </div>
    </div>
</div>

@auth
<!-- Become Agent Modal -->
<div class="modal fade" id="becomeAgentModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
            <div class="modal-header border-0 p-4 pb-0 bg-light">
                <h5 class="modal-title fw-800">Agent Application</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('user.agent-request.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4 bg-light">
                    <p class="text-muted small mb-4">Tell us about your real estate experience. Our admin team will review your application within 24 hours.</p>
                    <div class="mb-3">
                        <label class="small fw-bold mb-2">Your Professional Bio</label>
                        <textarea name="message" class="form-control border-0 shadow-sm rounded-4 p-3" rows="5" placeholder="Share your experience and why you'd like to join..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 bg-light">
                    <button type="button" class="btn btn-secondary bg-opacity-10 border-0 text-dark rounded-4 px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-premium px-5 rounded-4">Submit Application</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endauth

@endsection

@section('styles')
<style>
    .mt-n5 { margin-top: -6rem !important; }
    .last-child-no-border:last-child { border-bottom: none !important; }
    .card-img-top { transition: transform 0.6s cubic-bezier(0.2, 0.8, 0.2, 1); }
    .card:hover .card-img-top { transform: scale(1.1); }
    .bg-primary-soft { background: rgba(79, 70, 229, 0.1); color: var(--primary); }
    .fw-800 { font-weight: 800; }
</style>
@endsection
