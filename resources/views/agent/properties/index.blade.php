@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">My Properties</h1>
        <a href="{{ route('agent.properties.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> List New Property
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Image</th>
                            <th>Property</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stats</th>
                            <th>Availability</th>
                            <th>Approval</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($properties as $property)
                        <tr>
                            <td class="ps-4">
                                @if($property->images->count() > 0)
                                    <img src="{{ asset('storage/' . $property->images->first()->image_path) }}" alt="{{ $property->title }}" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $property->title }}</strong><br>
                                <small class="text-muted"><i class="bi bi-geo-alt"></i> {{ $property->location }}</small>
                            </td>
                            <td><span class="badge bg-secondary">{{ $property->category->name }}</span></td>
                            <td><strong class="text-primary">${{ number_format($property->price, 2) }}</strong></td>
                            <td>
                                <small class="text-muted">
                                    {{ $property->beds }} Bds | {{ $property->baths }} Bths | {{ $property->area }} sqft
                                </small>
                            </td>
                            <td>
                                <span class="badge {{ $property->availability == 'available' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($property->availability) }}
                                </span>
                            </td>
                            <td>
                                @if($property->is_approved)
                                    <span class="badge bg-info"><i class="bi bi-check-circle"></i> Approved</span>
                                @else
                                    <span class="badge bg-warning text-dark"><i class="bi bi-clock"></i> Pending</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('agent.properties.edit', $property->id) }}" class="btn btn-sm btn-outline-warning me-1">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('agent.properties.destroy', $property->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <i class="bi bi-building fs-1 text-muted"></i>
                                <p class="text-muted mt-2">No properties listed yet</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
