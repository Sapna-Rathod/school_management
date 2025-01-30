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
        <h2>Edit Student</h2>
        <form action="{{ route('students.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $student->user->name }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $student->user->email }}" required>
            </div>
            <div class="form-group mt-3">
                <label for="grade">Grade</label>
                <input type="text" name="grade" id="grade" class="form-control" value="{{ $student->grade }}" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Student</button>
            <a href="{{ route('students.index') }}" class="btn btn-primary">Cancel</a>
        </form>
    </div>
@endsection
