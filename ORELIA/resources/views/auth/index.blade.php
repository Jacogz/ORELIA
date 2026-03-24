@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $viewData['title'] }}</h1>
  <p>Welcome, {{ $viewData['admin_name'] }}</p>

  <div class="row mt-4">
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Materials</h5>
          <a href="{{ route('materials.index') }}" class="btn btn-primary">Manage Materials</a>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Users</h5>
          <a href="{{ route('users.index') }}" class="btn btn-primary">Manage Users</a>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Order Items</h5>
          <a href="{{ route('orderitems.index') }}" class="btn btn-primary">Manage Order Items</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection