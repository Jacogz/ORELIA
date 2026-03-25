@extends('layouts.app')

@section('title', $view_data['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $view_data['title'] }}</h1>

  <div class="card p-4">
    <div class="mb-3"><label class="fw-bold">{{ __('forms.id') }}:</label><p>{{ $view_data['piece']->get_id() }}</p></div>
    <div class="mb-3"><label class="fw-bold">{{ __('forms.name') }}:</label><p>{{ $view_data['piece']->get_name() }}</p></div>
    <div class="mb-3"><label class="fw-bold">{{ __('forms.price') }}:</label><p>{{ $view_data['piece']->get_price() }}</p></div>
    <div class="mb-3"><label class="fw-bold">{{ __('forms.type') }}:</label><p>{{ $view_data['piece']->get_type() }}</p></div>
    <div class="mb-3"><label class="fw-bold">{{ __('forms.image_url') }}:</label><p>{{ $view_data['piece']->get_image_url() }}</p></div>
    <div class="mb-3"><label class="fw-bold">{{ __('forms.stock') }}:</label><p>{{ $view_data['piece']->get_stock() }}</p></div>
    <div class="mb-3"><label class="fw-bold">{{ __('forms.size') }}:</label><p>{{ $view_data['piece']->get_size() }}</p></div>
    <div class="mb-3"><label class="fw-bold">{{ __('forms.weight') }}:</label><p>{{ $view_data['piece']->get_weight() }}</p></div>
    <div class="mb-3"><label class="fw-bold">{{ __('forms.collection_id') }}:</label><p>{{ $view_data['piece']->get_collection_id() }}</p></div>
    <a href="{{ route('pieces.index') }}" class="btn btn-secondary">{{ __('actions.back') }}</a>
  </div>
</div>
@endsection
