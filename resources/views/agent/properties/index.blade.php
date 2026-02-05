@extends('layouts.agent')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">My Properties</h1>
    <a href="{{ route('properties.create') }}" class="btn btn-primary mb-3">Add Property</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($properties as $prop)
            <tr>
                <td>{{ $prop->id }}</td>
                <td>{{ $prop->title }}</td>
                <td>{{ $prop->category->name }}</td>
                <td>{{ $prop->price }}</td>
                <td>{{ ucfirst($prop->status) }}</td>
                <td>
                    <a href="{{ route('properties.edit', $prop->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('properties.destroy', $prop->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
