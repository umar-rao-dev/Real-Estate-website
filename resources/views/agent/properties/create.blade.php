@extends('layouts.admin')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('agent.properties.index') }}" class="btn btn-light rounded-circle p-2 me-3" style="width: 40px; height: 40px;">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h3 class="fw-800 mb-0">Publish a Listing</h3>
        </div>

        <div class="card border-0 shadow-sm p-4">
            <div class="alert bg-warning-subtle text-warning border-0 p-3 rounded-4 mb-4 small d-flex align-items-center">
                <i class="bi bi-info-circle-fill fs-5 me-3"></i>
                <div>All agent listings are reviewed by administrators before becoming public. This ensures high-quality listings on our platform.</div>
            </div>

            <form action="{{ route('agent.properties.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">
                    <div class="col-md-8">
                        <div class="p-3 bg-light rounded-4 mb-4 border border-white">
                            <h6 class="fw-800 text-primary mb-3"><i class="bi bi-info-square-fill me-2"></i>Marketing Details</h6>
                            <div class="mb-3">
                                <label class="form-label fw-bold small text-muted">PROPERTY NAME</label>
                                <input type="text" name="name" class="form-control border-0 shadow-sm rounded-4 py-3" placeholder="Modern Penthouse with City View" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold small text-muted">DECRIPTION</label>
                                <textarea name="description" class="form-control border-0 shadow-sm rounded-4 p-3" rows="6" placeholder="Provide a detailed description of your property..." required></textarea>
                            </div>
                        </div>

                        <div class="p-3 bg-light rounded-4 border border-white">
                            <h6 class="fw-800 text-primary mb-3"><i class="bi bi-geo-alt-fill me-2"></i>Location & Area</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-muted">SQUARE FOOTAGE</label>
                                    <input type="number" name="area" class="form-control border-0 shadow-sm rounded-4 py-3" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-muted">OFFACT LOCATION</label>
                                    <input type="text" name="location" class="form-control border-0 shadow-sm rounded-4 py-3" placeholder="San Diego, CA" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-muted">BEDROOMS</label>
                                    <input type="number" name="beds" class="form-control border-0 shadow-sm rounded-4 py-3" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-muted">BATHROOMS</label>
                                    <input type="number" name="baths" class="form-control border-0 shadow-sm rounded-4 py-3" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-4 bg-white border border-light rounded-4 mb-4 shadow-sm">
                            <h6 class="fw-800 text-primary mb-4">Pricing Strategy</h6>
                            <div class="mb-4">
                                <label class="form-label fw-bold small text-muted">CATEGORY</label>
                                <select name="category_id" class="form-select border-0 bg-light rounded-4 py-3" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold small text-muted">LIST PRICE ($)</label>
                                <input type="number" name="price" class="form-control border-0 bg-light rounded-4 py-3" required>
                            </div>
                            <div class="mb-0">
                                <label class="form-label fw-bold small text-muted">LISTING TYPE</label>
                                <select name="type" class="form-select border-0 bg-light rounded-4 py-3" required>
                                    <option value="buy">For Sale</option>
                                    <option value="rent">For Rent</option>
                                </select>
                            </div>
                        </div>

                        <div class="p-4 bg-white border border-light rounded-4 shadow-sm mb-4">
                            <h6 class="fw-800 text-primary mb-3">Gallery Selection</h6>
                            <div class="mb-3">
                                <input type="file" name="images[]" class="form-control border-0 bg-light rounded-4 py-3" multiple accept="image/*">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-premium w-100 py-3 shadow mb-3">Submit for Review</button>
                        <a href="{{ route('agent.properties.index') }}" class="btn btn-light w-100 py-3 rounded-4 text-muted border-0">Cancel Listing</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .bg-warning-subtle { background-color: rgba(255, 193, 7, 0.1) !important; }
</style>
@endsection
