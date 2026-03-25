@extends('layouts.app')

@section('title', $view_data['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $view_data['title'] }}</h1>

  @if($view_data['orders']->count() > 0)
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Total</th>
            <th>{{ __('orders.loaded_items') }}</th>
            <th>Status</th>
            <th>{{ __('orders.creation_date') }}</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($view_data['orders'] as $order)
            <tr>
              <td>{{ $order->get_id() }}</td>
              <td>${{ number_format($order->get_total() / 100, 2) }}</td>
              <td>{{ count($order->get_order_items()) }}</td>
              <td>
                @if($order->get_status() === 'completed')
                  <span class="badge bg-success">{{ __('orders.status_completed') }}</span>
                @else
                  <span class="badge bg-info">{{ __('orders.status_in_transit') }}</span>
                @endif
              </td>
              <td>{{ $order->get_creation_date()->format('d/m/Y H:i') }}</td>
              <td>
                <a href="{{ route('orders.show', $order->get_id()) }}" class="btn btn-info btn-sm">{{ __('actions.view') }}</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @else
    <div class="alert alert-info">
      {{ __('history.no_history') }}
    </div>
  @endif
</div>
@endsection
