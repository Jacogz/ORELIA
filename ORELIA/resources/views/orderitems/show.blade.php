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
      <h5 class="card-title">{{ __('orderitems.order_item_information') }}</h5>

      <div class="mb-3">
        <label class="fw-bold">{{ __('forms.id') }}:</label>
        <p>{{ $view_data['orderitem']->get_id() }}</p>
      </div>

      <div class="mb-3">
        <label class="fw-bold">{{ __('forms.unit_price') }}:</label>
        <p>{{ $view_data['orderitem']->get_unit_price() }}</p>
      </div>

      <div class="mb-3">
        <label class="fw-bold">{{ __('forms.quantity') }}:</label>
        <p>{{ $view_data['orderitem']->get_quantity() }}</p>
      </div>

      <div class="mb-3">
        <label class="fw-bold">{{ __('forms.subtotal') }}:</label>
        <p>{{ $view_data['orderitem']->get_subtotal() }}</p>
      </div>

      <div class="mb-3">
        <label class="fw-bold">{{ __('forms.order_id') }}:</label>
        <p>{{ $view_data['orderitem']->get_order_id() }}</p>
      </div>

      <div class="mb-3">
        <label class="fw-bold">{{ __('forms.piece_id') }}:</label>
        <p>{{ $view_data['orderitem']->get_piece_id() }}</p>
      </div>

      <div class="mb-3">
        <label class="fw-bold">{{ __('forms.created') }}:</label>
        <p>{{ $view_data['orderitem']->created_at }}</p>
      </div>

      <div class="mb-3">
        <label class="fw-bold">{{ __('forms.updated') }}:</label>
        <p>{{ $view_data['orderitem']->updated_at }}</p>
      </div>
    </div>
  </div>

  <div class="mt-3">
    <a href="{{ route('orderitems.index') }}" class="btn btn-secondary">{{ __('orderitems.back_to_list') }}</a>
    <form action="{{ route('orderitems.delete', $view_data['orderitem']->get_id()) }}" method="POST" style="display:inline;">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('orderitems.confirm_delete_item') }}')">{{ __('orderitems.delete_order_item') }}</button>
    </form>
  </div>
</div>
@endsection