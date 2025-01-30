@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('announcements.create') }}" class="btn btn-primary mb-3" style="float:right;">Create Announcements</a>
        <h2>Announcements</h2>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($announcements->count())
            @foreach ($announcements as $announcement)
                <div class="card my-3">
                    <div class="card-body">
                        <h4>{{ $announcement->title }}</h4>
                        <p>{{ $announcement->content }}</p>
                        <small>Posted on {{ $announcement->created_at->format('M d, Y') }} by {{ $announcement->user->name }}.</small>
                        @if($announcement->target_students && $announcement->target_parents)
                            <small>Target to both Student & Parent</small>
                        @elseif($announcement->target_students)
                            <small>Target to Student</small>
                        @elseif($announcement->target_parents)
                            <small>Target to Parent</small>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <p>No announcements available.</p>
        @endif
    </div>
@endsection
