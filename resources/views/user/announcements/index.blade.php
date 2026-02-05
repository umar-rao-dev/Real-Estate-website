@extends('layouts.user')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Announcements</h1>

    @foreach($announcements as $announcement)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $announcement->title }}</h5>
            <p class="card-text">{{ $announcement->description }}</p>
        </div>
    </div>
    @endforeach
</div>
@endsection
