@extends('layouts.app')

@section('title', $view_data['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $view_data['title'] }}</h1>

  <div class="card p-4">
    <p><strong>ID:</strong> {{ $view_data['user']->get_id() }}</p>
    <p><strong>Name:</strong> {{ $view_data['user']->get_name() }}</p>
    <p><strong>Last Name:</strong> {{ $view_data['user']->get_last_name() }}</p>
    <p><strong>Email:</strong> {{ $view_data['user']->get_email() }}</p>
    <p><strong>Role:</strong> {{ $view_data['user']->get_role() }}</p>
    <p><strong>Address:</strong> {{ $view_data['user']->get_address() }}</p>

    <a href="{{ route('admin.users.edit', $view_data['user']->get_id()) }}" class="btn btn-secondary">Edit</a>
    <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Back</a>
  </div>
</div>
@endsection
