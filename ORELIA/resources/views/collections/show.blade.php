@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $viewData['title'] }}</h1>

  <div class="card p-4">
    <div class="mb-3">
      <label class="fw-bold">{{ __('forms.id') }}:</label>
      <p>{{ $viewData['collection']->get_id() }}</p>
    </div>

    <div class="mb-3">
      <label class="fw-bold">{{ __('forms.name') }}:</label>
      <p>{{ $viewData['collection']->get_name() }}</p>
    </div>

    <div class="mb-3">
      <label class="fw-bold">{{ __('collections.creation_date') }}:</label>
      <p>{{ $viewData['collection']->get_creation_date() }}</p>
    </div>

    <div class="mb-3">
      <label class="fw-bold">{{ __('collections.pieces_loaded') }}:</label>
      <p>{{ count($viewData['collection']->get_pieces()) }}</p>
    </div>

    <a href="{{ route('collections.index') }}" class="btn btn-secondary">{{ __('actions.back') }}</a>
  </div>
</div>
@endsection
