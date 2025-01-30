@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="d-flex justify-content-center align-items-center ">
        <div class="card p-4 shadow-lg">
            <h2 class="text-center">Welcome to School Management</h2>
        </div>
    </div>

</div>
<div class="container mt-5 text-center">
    @if (auth()->user()->role_id == 1)
        <a href="{{ route('teachers.index') }}" class="btn btn-primary mb-3">Teacher</a>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mb-3">Added By Teacher</a>
    @endif
    @if (auth()->user()->role_id == 2)
        <a href="{{ route('students.index') }}" class="btn btn-primary mb-3">Students</a>
        <a href="{{ route('parents.index') }}" class="btn btn-primary mb-3">Parents</a>
    @endif
    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
        <a href="{{ route('announcements.index') }}" class="btn btn-primary mb-3">Announcements</a>
    @endif
</div>
@endsection
