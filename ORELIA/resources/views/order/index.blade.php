@extends('layouts.app')

@section('title', $view_data['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $view_data['title'] }}</h1>

  <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Create Order</a>

  @if($view_data['orders']->count() > 0)
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Total</th>
          <th>Status</th>
          <th>Client ID</th>
          <th>Payment Method</th>
          <th>Payment Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($view_data['orders'] as $order)
          <tr>
            <td>{{ $order->get_id() }}</td>
            <td>{{ $order->get_total() }}</td>
            <td>{{ $order->get_status() }}</td>
            <td>{{ $order->get_client_id() }}</td>
            <td>{{ $order->get_payment_method() }}</td>
            <td>{{ $order->get_payment_status() }}</td>
            <td>
              <a href="{{ route('orders.show', $order->get_id()) }}" class="btn btn-info btn-sm">View</a>
              <form action="{{ route('orders.destroy', $order->get_id()) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <div class="alert alert-info">No orders found. <a href="{{ route('orders.create') }}">Create one</a></div>
  @endif
</div>
@endsection
