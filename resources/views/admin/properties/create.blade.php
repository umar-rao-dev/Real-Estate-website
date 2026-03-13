@extends('layouts.admin')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('admin.properties.index') }}" class="btn btn-light rounded-circle p-2 me-3" style="width: 40px; height: 40px;">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h3 class="fw-800 mb-0">List New Property</h3>
        </div>

        <div class="card border-0 shadow-sm p-4 pt-1">
            <form action="{{ route('admin.properties.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">
                    <!-- General Details -->
                    <div class="col-md-8">
                        <div class="p-3 bg-light rounded-4 mb-4">
                            <h6 class="fw-800 text-primary mb-3"><i class="bi bi-info-circle me-2"></i>Core Information</h6>
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Property Display Name</label>
                                <input type="text" name="name" class="form-control border-0 shadow-sm rounded-3 py-2" placeholder="e.g. Luxury Beachside Villa" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Detailed Description</label>
                                <textarea name="description" class="form-control border-0 shadow-sm rounded-3" rows="6" placeholder="Describe the architectural highlights, neighborhood, and unique features..." required></textarea>
                            </div>
                        </div>

                        <div class="p-3 bg-light rounded-4">
                            <h6 class="fw-800 text-primary mb-3"><i class="bi bi-geo-alt me-2"></i>Spatial & Location</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">Area (Sq Ft)</label>
                                    <input type="number" name="area" class="form-control border-0 shadow-sm rounded-3 py-2" placeholder="2500" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">Location / City</label>
                                    <input type="text" name="location" class="form-control border-0 shadow-sm rounded-3 py-2" placeholder="Beverly Hills, CA" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">Bedrooms</label>
                                    <input type="number" name="beds" class="form-control border-0 shadow-sm rounded-3 py-2" placeholder="3" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small">Bathrooms</label>
                                    <input type="number" name="baths" class="form-control border-0 shadow-sm rounded-3 py-2" placeholder="2" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Side Options -->
                    <div class="col-md-4">
                        <div class="p-3 bg-white border border-light rounded-4 mb-4 shadow-sm">
                            <h6 class="fw-800 text-primary mb-3"><i class="bi bi-tag me-2"></i>Pricing & Type</h6>
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Category</label>
                                <select name="category_id" class="form-select border-0 bg-light rounded-3" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Asking Price ($)</label>
                                <input type="number" name="price" class="form-control border-0 bg-light rounded-3 py-2" placeholder="450000" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Listing Type</label>
                                <select name="type" class="form-select border-0 bg-light rounded-3" required>
                                    <option value="buy">For Sale</option>
                                    <option value="rent">For Rent</option>
                                </select>
                            </div>
                        </div>

                        <div class="p-3 bg-white border border-light rounded-4 shadow-sm">
                            <h6 class="fw-800 text-primary mb-3"><i class="bi bi-images me-2"></i>Visual Media</h6>
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Upload Photos</label>
                                <input type="file" name="images[]" class="form-control border-0 bg-light rounded-3" multiple accept="image/*">
                                <div class="extra-small text-muted mt-2">Hold Ctrl to select multiple high-quality images.</div>
                            </div>
                            <div class="form-check form-switch mt-4">
                                <input class="form-check-input" type="checkbox" id="autoApprove" checked disabled>
                                <label class="form-check-label small fw-bold" for="autoApprove">Admin Auto-Approval Enabled</label>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-gradient w-100 py-3 mb-3 shadow">Publish Property</button>
                            <a href="{{ route('admin.properties.index') }}" class="btn btn-light w-100 py-2 rounded-3 text-muted">Discard Draft</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .extra-small { font-size: 0.7rem; }
</style>
@endsection