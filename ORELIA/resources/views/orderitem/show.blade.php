@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $viewData['title'] }}</h1>

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
        <p>{{ $viewData['orderitem']->get_id() }}</p>
      </div>

      <div class="mb-3">
        <label class="fw-bold">Unit Price:</label>
        <p>{{ $viewData['orderitem']->get_unit_price() }}</p>
      </div>

      <div class="mb-3">
        <label class="fw-bold">Quantity:</label>
        <p>{{ $viewData['orderitem']->get_quantity() }}</p>
      </div>

      <div class="mb-3">
        <label class="fw-bold">Subtotal:</label>
        <p>{{ $viewData['orderitem']->get_subtotal() }}</p>
      </div>

      <div class="mb-3">
        <label class="fw-bold">Order ID:</label>
        <p>{{ $viewData['orderitem']->get_order_id() }}</p>
      </div>

      <div class="mb-3">
        <label class="fw-bold">Piece ID:</label>
        <p>{{ $viewData['orderitem']->get_piece_id() }}</p>
      </div>

      <div class="mb-3">
        <label class="fw-bold">Created At:</label>
        <p>{{ $viewData['orderitem']->created_at }}</p>
      </div>

      <div class="mb-3">
        <label class="fw-bold">Updated At:</label>
        <p>{{ $viewData['orderitem']->updated_at }}</p>
      </div>
    </div>
  </div>

  <div class="mt-3">
    <a href="{{ route('orderitems.index') }}" class="btn btn-secondary">Back to List</a>
    <form action="{{ route('orderitems.destroy', $viewData['orderitem']->get_id()) }}" method="POST" style="display:inline;">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order item?')">Delete Order Item</button>
    </form>
  </div>
</div>
@endsection