@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $viewData['title'] }}</h1>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Unit Price</th>
        <th>Quantity</th>
        <th>Subtotal</th>
        <th>Order ID</th>
        <th>Piece ID</th>
        <th>Action</th>
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
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
