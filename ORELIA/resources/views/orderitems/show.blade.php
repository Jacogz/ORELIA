@extends('layouts.app')

@section('title', $view_data['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $view_data['title'] }}</h1>

  @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Order Item Information</h5>

      <div class="mb-3">
        <label class="fw-bold">ID:</label>
        <p>{{ $view_data['order_item']->get_id() }}</p>
      </div>

      <div class="mb-3">
        <label class="fw-bold">Unit Price:</label>
        <p>{{ $view_data['order_item']->get_unit_price() }}</p>
      </div>

      <div class="mb-3">
        <label class="fw-bold">Quantity:</label>
        <p>{{ $view_data['order_item']->get_quantity() }}</p>
      </div>

      <div class="mb-3">
        <label class="fw-bold">Subtotal:</label>
        <p>{{ $view_data['order_item']->get_subtotal() }}</p>
      </div>

      <div class="mb-3">
        <label class="fw-bold">Order ID:</label>
        <p>{{ $view_data['order_item']->get_order_id() }}</p>
      </div>

      <div class="mb-3">
        <label class="fw-bold">Piece ID:</label>
        <p>{{ $view_data['order_item']->get_piece_id() }}</p>
      </div>

      <div class="mb-3">
        <label class="fw-bold">Created At:</label>
        <p>{{ $view_data['order_item']->created_at }}</p>
      </div>

      <div class="mb-3">
        <label class="fw-bold">Updated At:</label>
        <p>{{ $view_data['order_item']->updated_at }}</p>
      </div>
    </div>
  </div>

  <div class="mt-3">
    <a href="{{ route('order_items.index') }}" class="btn btn-secondary">Back to List</a>
    <form action="{{ route('order_items.delete', $view_data['order_item']->get_id()) }}" method="POST" style="display:inline;">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order item?')">Delete Order Item</button>
    </form>
  </div>
</div>
@endsection