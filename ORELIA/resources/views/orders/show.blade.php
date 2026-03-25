@extends('layouts.app')

@section('title', $view_data['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $view_data['title'] }}</h1>

  <div class="card p-4">
    <div class="mb-3"><label class="fw-bold">{{ __('forms.id') }}:</label><p>{{ $viewData['order']->get_id() }}</p></div>
    <div class="mb-3"><label class="fw-bold">{{ __('forms.total') }}:</label><p>{{ $viewData['order']->get_total() }}</p></div>
    <div class="mb-3"><label class="fw-bold">{{ __('collections.creation_date') }}:</label><p>{{ $viewData['order']->get_creation_date() }}</p></div>
    <div class="mb-3"><label class="fw-bold">{{ __('forms.status') }}:</label><p>{{ $viewData['order']->get_status() }}</p></div>
    <div class="mb-3"><label class="fw-bold">{{ __('forms.client_id') }}:</label><p>{{ $viewData['order']->get_client_id() }}</p></div>
    <div class="mb-3"><label class="fw-bold">{{ __('forms.payment_method') }}:</label><p>{{ $viewData['order']->get_payment_method() }}</p></div>
    <div class="mb-3"><label class="fw-bold">{{ __('forms.payment_status') }}:</label><p>{{ $viewData['order']->get_payment_status() }}</p></div>
    <div class="mb-3"><label class="fw-bold">{{ __('orders.loaded_items') }}:</label><p>{{ count($viewData['order']->get_order_items()) }}</p></div>
    <a href="{{ route('orders.index') }}" class="btn btn-secondary">{{ __('actions.back') }}</a>
  </div>
</div>
@endsection
