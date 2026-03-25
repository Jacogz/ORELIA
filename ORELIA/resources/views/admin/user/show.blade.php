@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $viewData['title'] }}</h1>

  <div class="card p-4">
    <p><strong>ID:</strong> {{ $viewData['user']->get_id() }}</p>
    <p><strong>Name:</strong> {{ $viewData['user']->get_name() }}</p>
    <p><strong>Last Name:</strong> {{ $viewData['user']->get_last_name() }}</p>
    <p><strong>Email:</strong> {{ $viewData['user']->get_email() }}</p>
    <p><strong>Role:</strong> {{ $viewData['user']->get_role() }}</p>
    <p><strong>Address:</strong> {{ $viewData['user']->get_address() }}</p>

    <a href="{{ route('admin.users.edit', $viewData['user']->get_id()) }}" class="btn btn-secondary">Edit</a>
    <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Back</a>
  </div>
</div>
@endsection
