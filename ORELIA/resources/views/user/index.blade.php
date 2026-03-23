@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $viewData['title'] }}</h1>

  <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Create User</a>

  @if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

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
      @foreach($viewData['users'] as $user)
        <tr>
          <td>{{ $user->get_id() }}</td>
          <td>{{ $user->get_name() }}</td>
          <td>{{ $user->get_last_name() }}</td>
          <td>{{ $user->get_email() }}</td>
          <td>{{ $user->get_role() }}</td>
          <td>
            <a href="{{ route('users.show', $user->get_id()) }}" class="btn btn-info btn-sm">View</a>
            <form action="{{ route('users.destroy', $user->get_id()) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection