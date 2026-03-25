@extends('layouts.app')

@section('title', $view_data['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $view_data['title'] }}</h1>

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
          <th>Action</th>
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
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <div class="alert alert-info">No orders found.</div>
  @endif
</div>
@endsection
