@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h2>Edit Teacher</h2>
        <form action="{{ route('teachers.update', $teacher->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $teacher->user->name }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $teacher->user->email }}" required>
            </div>
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" name="subject" id="subject" class="form-control" value="{{ $teacher->subject }}" required>
            </div>
            <div class="form-group">
                <label for="hire_date">Hire Date</label>
                <input type="date" name="hire_date" id="hire_date" class="form-control" value="{{ $teacher->hire_date }}" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Teacher</button>
            <a href="{{ route('teachers.index') }}" class="btn btn-primary">Cancel</a>
        </form>
    </div>
@endsection
