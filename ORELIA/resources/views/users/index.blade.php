@extends('layouts.app')

@section('title', $view_data['title'])

@section('content')
<div class="container mt-4">
    <h1>{{ $view_data['title'] }}</h1>

    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Create User</a>

    @if($view_data['users']->count() > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($view_data['users'] as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">View</a>
                            <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">No users found. <a href="{{ route('admin.users.create') }}">Create one</a></div>
    @endif
</div>
@endsection