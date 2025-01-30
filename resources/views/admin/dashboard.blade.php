@extends('layouts.app')

@section('content')
    <div class="container mt-5 text-center">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
    <div class="container">
        <h2>Students</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Grade</th>
                    <th>Created by Teacher</th>
                </tr>
            </thead>
            <tbody>
                @if($students)
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->user->name }}</td>
                            <td>{{ $student->user->email }}</td>
                            <td>{{ $student->grade }}</td>
                            <td>{{ $student->teacher->user->name }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div class="container">
        <h2>Parents</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Parent Name</th>
                    <th>Email</th>
                    <th>Contact No</th>
                    <th>Student</th>
                </tr>
            </thead>
            <tbody>
                @if($parents)
                    @foreach($parents as $parent)
                        <tr>
                            <td>{{ $parent->user->name }}</td>
                            <td>{{ $parent->user->email }}</td>
                            <td>{{ $parent->contact_number }}</td>
                            <td>{{ $parent->student->user->name }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div class="container">
        <h2>Announcements</h2>
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
