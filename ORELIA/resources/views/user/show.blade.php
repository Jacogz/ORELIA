@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $viewData['title'] }}</h1>

  @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">User Information</h5>

      <div class="mb-3">
        <label class="fw-bold">ID:</label>
        <p>{{ $viewData['user']->get_id() }}</p>
      </div>

      <div class="mb-3">
        <label class="fw-bold">Name:</label>
        <p>{{ $viewData['user']->get_name() }}</p>
      </div>

      <div class="mb-3">
        <label class="fw-bold">Last Name:</label>
        <p>{{ $viewData['user']->get_last_name() }}</p>
      </div>

      <div class="mb-3">
        <label class="fw-bold">Email:</label>
        <p>{{ $viewData['user']->get_email() }}</p>
      </div>

      <div class="mb-3">
        <label class="fw-bold">Role:</label>
        <p>{{ $viewData['user']->get_role() }}</p>
      </div>

      <div class="mb-3">
        <label class="fw-bold">Address:</label>
        <p>{{ $viewData['user']->get_address() }}</p>
      </div>

      <div class="mb-3">
        <label class="fw-bold">Created At:</label>
        <p>{{ $viewData['user']->created_at }}</p>
      </div>

      <div class="mb-3">
        <label class="fw-bold">Updated At:</label>
        <p>{{ $viewData['user']->updated_at }}</p>
      </div>
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