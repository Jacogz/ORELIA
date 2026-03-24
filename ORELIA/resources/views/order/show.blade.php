@extends('layouts.app')

@section('title', $view_data['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $view_data['title'] }}</h1>

  <div class="card p-4">
    <div class="mb-3"><label class="fw-bold">ID:</label><p>{{ $view_data['order']->get_id() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Total:</label><p>{{ $view_data['order']->get_total() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Creation Date:</label><p>{{ $view_data['order']->get_creation_date() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Status:</label><p>{{ $view_data['order']->get_status() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Client ID:</label><p>{{ $view_data['order']->get_client_id() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Payment Method:</label><p>{{ $view_data['order']->get_payment_method() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Payment Status:</label><p>{{ $view_data['order']->get_payment_status() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Loaded Items:</label><p>{{ count($view_data['order']->get_order_items()) }}</p></div>
    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back</a>
  </div>
</div>
@endsection
