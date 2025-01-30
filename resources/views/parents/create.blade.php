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
        <h2>Add New Parent</h2>
        <form action="{{ route('parents.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="student_id">Select Student</label>
                <select name="student_id" id="student_id" class="form-control" required>
                    <option value="" disabled selected>Select a student</option>
                    @foreach ($students as $student)
                        <option value="{{ $student->user_id }}">{{ $student->user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-3">
                <label for="contact_no">Contact No</label>
                <input type="text" name="contact_no" id="contact_no" pattern="^\d{10}$" class="form-control" required title="Please enter exactly 10 digits.">
            </div>

            <button type="submit" class="btn btn-success mt-3">Add Parent</button>
            <a href="{{ route('teachers.index') }}" class="btn btn-primary">Cancel</a>
        </form>
    </div>
@endsection
