@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center mt-5">
  <div class="col-md-5">
    <div class="card">
      <div class="card-header">
        <h4 class="mb-0">Login</h4>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('login.authenticate') }}">
          @csrf

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email"
                   class="form-control"
                   value="{{ old('email') }}" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password"
                   class="form-control" required>
          </div>

          <button type="submit" class="btn btn-primary w-100">Log In</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection