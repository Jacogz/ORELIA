@extends('layouts.app')

@section('title', $view_data['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $view_data['title'] }}</h1>

  <div class="card p-4">
    <div class="mb-3">
      <label class="fw-bold">ID:</label>
      <p>{{ $view_data['collection']->get_id() }}</p>
    </div>

    <div class="mb-3">
      <label class="fw-bold">Name:</label>
      <p>{{ $view_data['collection']->get_name() }}</p>
    </div>

    <div class="mb-3">
      <label class="fw-bold">Creation Date:</label>
      <p>{{ $view_data['collection']->get_creation_date() }}</p>
    </div>

    <div class="mb-3">
      <label class="fw-bold">Pieces Loaded:</label>
      <p>{{ count($view_data['collection']->get_pieces()) }}</p>
    </div>

    <a href="{{ route('collections.index') }}" class="btn btn-secondary">Back</a>
  </div>
</div>
@endsection
