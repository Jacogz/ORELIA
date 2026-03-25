@extends('layouts.app')

@section('title', __('navigation.admin_panel'))

@section('content')
<div class="container mt-4">
  <h1>{{ __('navigation.admin_panel') }}</h1>
  <p>{{ __('messages.welcome') }}, {{ $view_data['admin_name'] }}</p>

  <div class="row mt-4">
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{ __('navigation.materials') }}</h5>
          <a href="{{ route('materials.index') }}" class="btn btn-primary">{{ __('actions.manage_materials') }}</a>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{ __('navigation.users') }}</h5>
          <a href="{{ route('admin.users.index') }}" class="btn btn-primary">{{ __('actions.manage_users') }}</a>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{ __('navigation.order_items') }}</h5>
          <a href="{{ route('orderitems.index') }}" class="btn btn-primary">{{ __('actions.manage_order_items') }}</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection