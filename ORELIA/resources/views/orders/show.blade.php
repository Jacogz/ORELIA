@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $viewData['title'] }}</h1>

  <div class="card p-4">
    <div class="mb-3"><label class="fw-bold">ID:</label><p>{{ $viewData['order']->get_id() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Total:</label><p>{{ $viewData['order']->get_total() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Creation Date:</label><p>{{ $viewData['order']->get_creation_date() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Status:</label><p>{{ $viewData['order']->get_status() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Client ID:</label><p>{{ $viewData['order']->get_client_id() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Payment Method:</label><p>{{ $viewData['order']->get_payment_method() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Payment Status:</label><p>{{ $viewData['order']->get_payment_status() }}</p></div>
    <div class="mb-3"><label class="fw-bold">Loaded Items:</label><p>{{ count($viewData['order']->get_order_items()) }}</p></div>
    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back</a>
  </div>
</div>
@endsection
