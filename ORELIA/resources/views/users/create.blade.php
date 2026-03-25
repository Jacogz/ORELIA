@extends('layouts.app')

@section('title', $view_data['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $view_data['title'] }}</h1>

  <form action="{{ route('admin.users.store') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label for="name" class="form-label">{{ __('forms.name') }}</label>
      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
      @error('name')
        <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="last_name" class="form-label">{{ __('forms.last_name') }}</label>
      <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
      @error('last_name')
        <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">{{ __('forms.email') }}</label>
      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
      @error('email')
        <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">{{ __('forms.password') }}</label>
      <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
      @error('password')
        <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="role" class="form-label">{{ __('forms.role') }}</label>
      <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
        <option value="">{{ __('users.select_role') }}</option>
        <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>{{ __('users.client') }}</option>
        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>{{ __('users.admin') }}</option>
      </select>
      @error('role')
        <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div>

    <div class="mb-3">
      <label for="address" class="form-label">{{ __('forms.address') }}</label>
      <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}">
      @error('address')
        <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">{{ __('users.create_user') }}</button>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">{{ __('actions.cancel') }}</a>
  </form>
</div>
@endsection