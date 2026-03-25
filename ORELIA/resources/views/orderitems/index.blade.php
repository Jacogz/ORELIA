@extends('layouts.app')

@section('title', $view_data['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $view_data['title'] }}</h1>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>{{ __('forms.id') }}</th>
        <th>{{ __('forms.unit_price') }}</th>
        <th>{{ __('forms.quantity') }}</th>
        <th>{{ __('forms.subtotal') }}</th>
        <th>{{ __('forms.order_id') }}</th>
        <th>{{ __('forms.piece_id') }}</th>
        <th>{{ __('materials.action') }}</th>
      </tr>
    </thead>
    <tbody>
      @foreach($view_data['order_items'] as $orderitem)
        <tr>
          <td>{{ $orderitem->get_id() }}</td>
          <td>{{ $orderitem->get_unit_price() }}</td>
          <td>{{ $orderitem->get_quantity() }}</td>
          <td>{{ $orderitem->get_subtotal() }}</td>
          <td>{{ $orderitem->get_order_id() }}</td>
          <td>{{ $orderitem->get_piece_id() }}</td>
          <td>
            <a href="{{ route('orderitems.show', $orderitem->get_id()) }}" class="btn btn-info btn-sm">{{ __('actions.view') }}</a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
