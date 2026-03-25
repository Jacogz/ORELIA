@extends('layouts.app')

@section('title', $view_data['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $view_data['title'] }}</h1>

  @if($view_data['orders']->count() > 0)
    <table class="table table-striped">
      <thead>
        <tr>
          <th>{{ __('forms.id') }}</th>
          <th>{{ __('forms.total') }}</th>
          <th>{{ __('forms.status') }}</th>
          <th>{{ __('forms.client_id') }}</th>
          <th>{{ __('forms.payment_method') }}</th>
          <th>{{ __('forms.payment_status') }}</th>
          <th>{{ __('materials.action') }}</th>
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
              <a href="{{ route('orders.show', $order->get_id()) }}" class="btn btn-info btn-sm">{{ __('actions.view') }}</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <div class="alert alert-info">{{ __('orders.no_orders_found') }}</div>
  @endif
</div>
@endsection
