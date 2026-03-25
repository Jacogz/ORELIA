@extends('layouts.app')

@section('title', $view_data['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $view_data['title'] }}</h1>

  <form action="{{ route('admin.users.store') }}" method="POST" class="card p-4">
    @csrf

    <div class="mb-3">
      <label for="name" class="form-label">{{ __('forms.name') }}</label>
      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
      @error('name')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label for="last_name" class="form-label">{{ __('forms.last_name') }}</label>
      <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
      @error('last_name')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">{{ __('forms.email') }}</label>
      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
      @error('email')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">{{ __('forms.password') }}</label>
      <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
      @error('password')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label for="role" class="form-label">{{ __('forms.role') }}</label>
      <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
        <option value="">{{ __('forms.select_role') }}</option>
        <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>{{ __('forms.client') }}</option>
        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>{{ __('forms.admin') }}</option>
      </select>
      @error('role')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label for="address" class="form-label">{{ __('forms.address') }}</label>
      <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}">
      @error('address')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <button type="submit" class="btn btn-primary">{{ __('actions.save') }}</button>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">{{ __('actions.cancel') }}</a>
  </form>
</div>
@endsection
