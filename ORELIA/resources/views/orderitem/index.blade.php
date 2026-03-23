@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $viewData['title'] }}</h1>

  <a href="{{ route('orderitems.create') }}" class="btn btn-primary mb-3">Create Order Item</a>

  @if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Unit Price</th>
        <th>Quantity</th>
        <th>Subtotal</th>
        <th>Order ID</th>
        <th>Piece ID</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($viewData['orderitems'] as $orderitem)
        <tr>
          <td>{{ $orderitem->get_id() }}</td>
          <td>{{ $orderitem->get_unit_price() }}</td>
          <td>{{ $orderitem->get_quantity() }}</td>
          <td>{{ $orderitem->get_subtotal() }}</td>
          <td>{{ $orderitem->get_order_id() }}</td>
          <td>{{ $orderitem->get_piece_id() }}</td>
          <td>
            <a href="{{ route('orderitems.show', $orderitem->get_id()) }}" class="btn btn-info btn-sm">View</a>
            <form action="{{ route('orderitems.destroy', $orderitem->get_id()) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection