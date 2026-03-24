@extends('layouts.app')

@section('title', $view_data['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $view_data['title'] }}</h1>

  <div class="card p-4">
    <p><strong>ID:</strong> {{ $view_data['material']->get_id() }}</p>
    <p><strong>Name:</strong> {{ $view_data['material']->get_name() }}</p>
    <p><strong>Type:</strong> {{ $view_data['material']->get_type() }}</p>
    <p><strong>Description:</strong> {{ $view_data['material']->get_description() }}</p>
    <p><strong>Color:</strong> {{ $view_data['material']->get_color() }}</p>

    <a href="{{ route('admin.materials.edit', $view_data['material']->get_id()) }}" class="btn btn-secondary">Edit</a>
    <a href="{{ route('admin.materials.index') }}" class="btn btn-primary">Back</a>
  </div>
</div>
@endsection
