@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create New Announcement</h2>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('announcements.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <div class="form-group mt-3">
                <label for="content">Content</label>
                <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
            </div>

            @if (Auth::user() && Auth::user()->role_id == 2)
                <div class="form-check mt-3">
                    <input type="checkbox" name="target_students" id="target_students" class="form-check-input">
                    <label for="target_students" class="form-check-label">Target Students</label>
                </div>

                <div class="form-check mt-3">
                    <input type="checkbox" name="target_parents" id="target_parents" class="form-check-input">
                    <label for="target_parents" class="form-check-label">Target Parents</label>
                </div>
            @endif

            <button type="submit" class="btn btn-success mt-3">Post Announcement</button>
            <a href="{{ route('announcements.index') }}" class="btn btn-primary mt-3">Back</a>
        </form>
    </div>
@endsection
