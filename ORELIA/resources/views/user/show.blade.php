@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $viewData['title'] }}</h1>

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">User Information</h5>

      <p><strong>ID:</strong> {{ $viewData['user']->get_id() }}</p>
      <p><strong>Name:</strong> {{ $viewData['user']->get_name() }}</p>
      <p><strong>Last Name:</strong> {{ $viewData['user']->get_last_name() }}</p>
      <p><strong>Email:</strong> {{ $viewData['user']->get_email() }}</p>
      <p><strong>Role:</strong> {{ $viewData['user']->get_role() }}</p>
      <p><strong>Address:</strong> {{ $viewData['user']->get_address() }}</p>
      <p><strong>Created At:</strong> {{ $viewData['user']->created_at }}</p>
      <p><strong>Updated At:</strong> {{ $viewData['user']->updated_at }}</p>
    </div>
  </div>

  <div class="mt-3">
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to List</a>
    <form action="{{ route('users.destroy', $viewData['user']->get_id()) }}" method="POST" style="display:inline;">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete User</button>
    </form>
  </div>
</div>
@endsection 