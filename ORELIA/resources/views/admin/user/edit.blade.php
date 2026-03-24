@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $viewData['title'] }}</h1>

  <form action="{{ route('admin.users.update', $viewData['user']->get_id()) }}" method="POST" class="card p-4">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $viewData['user']->get_name()) }}" required>
      @error('name')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label for="last_name" class="form-label">Last Name</label>
      <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name', $viewData['user']->get_last_name()) }}" required>
      @error('last_name')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $viewData['user']->get_email()) }}" required>
      @error('email')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password (optional)</label>
      <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
      @error('password')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label for="role" class="form-label">Role</label>
      <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
        <option value="client" {{ old('role', $viewData['user']->get_role()) == 'client' ? 'selected' : '' }}>Client</option>
        <option value="admin" {{ old('role', $viewData['user']->get_role()) == 'admin' ? 'selected' : '' }}>Admin</option>
      </select>
      @error('role')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label for="address" class="form-label">Address</label>
      <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $viewData['user']->get_address()) }}">
      @error('address')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
  </form>
</div>
@endsection
