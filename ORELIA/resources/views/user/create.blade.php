@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $viewData['title'] }}</h1>

  @if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('users.store') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
      @error('name')
        <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="last_name" class="form-label">Last Name</label>
      <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
      @error('last_name')
        <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
      @error('email')
        <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
      @error('password')
        <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="role" class="form-label">Role</label>
      <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
        <option value="">Select Role</option>
        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
      </select>
      @error('role')
        <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="address" class="form-label">Address</label>
      <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}">
      @error('address')
        <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">Create User</button>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
  </form>
</div>
@endsection