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
        <a href="{{ route('parents.create') }}" class="btn btn-primary mb-3" style="float:right;">Add New Parent</a>
        <h2>Parents</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Parent Name</th>
                    <th>Email</th>
                    <th>Contact No</th>
                    <th>Student</th>
                    <th>Actions</th>
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
                            <td>
                                <a href="{{ route('parents.edit', $parent->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('parents.destroy', $parent->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete parent?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection
