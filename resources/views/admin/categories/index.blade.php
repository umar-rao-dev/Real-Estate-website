@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-800 mb-0">Property Categories</h3>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-gradient">
        <i class="bi bi-plus-lg me-2"></i> Add Category
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="card border-0 shadow-sm overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light text-muted small-caps">
                <tr>
                    <th class="ps-4 py-3">Category Name</th>
                    <th class="py-3">Description</th>
                    <th class="py-3">Created Date</th>
                    <th class="text-end pe-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $cat)
                <tr>
                    <td class="ps-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                <i class="bi bi-tag-fill"></i>
                            </div>
                            <div class="fw-800">{{ $cat->name }}</div>
                        </div>
                    </td>
                    <td>
                        <div class="text-muted small">
                            {{ Str::limit($cat->description, 80) ?: 'No description provided.' }}
                        </div>
                    </td>
                    <td class="small fw-500">{{ $cat->created_at->format('M d, Y') }}</td>
                    <td class="text-end pe-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.categories.edit', $cat->id) }}" class="btn btn-sm btn-light rounded-3 px-3">
                                <i class="bi bi-pencil me-1"></i> Edit
                            </a>
                            <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-light text-danger rounded-3 px-3" onclick="return confirm('Delete this category? This will affect properties in this category.')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-5">
                        <div class="opacity-25 mb-3"><i class="bi bi-folder-x fs-1"></i></div>
                        <p class="text-muted fw-bold">No categories defined yet.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('styles')
<style>
    .small-caps { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 700; }
</style>
@endsection
