@extends('layouts.app')

@section('title', $view_data['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $view_data['title'] }}</h1>

  <div class="card p-4">
    <div class="mb-3"><label class="fw-bold">ID:</label><p>{{ $view_data['piece']->get_id() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Name:</label><p>{{ $view_data['piece']->get_name() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Price:</label><p>{{ $view_data['piece']->get_price() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Type:</label><p>{{ $view_data['piece']->get_type() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Image URL:</label><p>{{ $view_data['piece']->get_image_url() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Stock:</label><p>{{ $view_data['piece']->get_stock() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Size:</label><p>{{ $view_data['piece']->get_size() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Weight:</label><p>{{ $view_data['piece']->get_weight() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Collection ID:</label><p>{{ $view_data['piece']->get_collection_id() }}</p></div>
    <a href="{{ route('pieces.index') }}" class="btn btn-secondary">Back</a>
  </div>
</div>
@endsection
