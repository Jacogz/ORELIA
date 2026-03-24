@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $viewData['title'] }}</h1>

  <div class="card p-4">
    <p><strong>ID:</strong> {{ $viewData['material']->get_id() }}</p>
    <p><strong>Name:</strong> {{ $viewData['material']->get_name() }}</p>
    <p><strong>Type:</strong> {{ $viewData['material']->get_type() }}</p>
    <p><strong>Description:</strong> {{ $viewData['material']->get_description() }}</p>
    <p><strong>Color:</strong> {{ $viewData['material']->get_color() }}</p>

    <a href="{{ route('admin.materials.edit', $viewData['material']->get_id()) }}" class="btn btn-secondary">Edit</a>
    <a href="{{ route('admin.materials.index') }}" class="btn btn-primary">Back</a>
  </div>
</div>
@endsection
