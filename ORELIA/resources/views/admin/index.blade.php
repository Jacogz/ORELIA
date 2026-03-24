@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="container mt-4">
  <h1>{{ $title }}</h1>
  <p>Welcome, {{ $admin_name }}!</p>

  <div class="row g-3 mt-2">
    <div class="col-md-6">
      <div class="card p-4">
        <h4>Materials CRUD</h4>
        <p>Admin-only management for materials.</p>
        <a href="{{ route('admin.materials.index') }}" class="btn btn-primary">Open Materials</a>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card p-4">
        <h4>Users CRUD</h4>
        <p>Admin-only management for users.</p>
        <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Open Users</a>
      </div>
    </div>
  </div>
</div>
@endsection
