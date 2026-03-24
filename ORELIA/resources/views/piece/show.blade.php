@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $viewData['title'] }}</h1>

  <div class="card p-4">
    <div class="mb-3"><label class="fw-bold">ID:</label><p>{{ $viewData['piece']->get_id() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Name:</label><p>{{ $viewData['piece']->get_name() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Price:</label><p>{{ $viewData['piece']->get_price() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Type:</label><p>{{ $viewData['piece']->get_type() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Image URL:</label><p>{{ $viewData['piece']->get_image_url() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Stock:</label><p>{{ $viewData['piece']->get_stock() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Size:</label><p>{{ $viewData['piece']->get_size() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Weight:</label><p>{{ $viewData['piece']->get_weight() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Collection ID:</label><p>{{ $viewData['piece']->get_collection_id() }}</p></div>
    <a href="{{ route('pieces.index') }}" class="btn btn-secondary">Back</a>
  </div>
</div>
@endsection
