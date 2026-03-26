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
  <h3 class="mt-5 mb-3">Top 3 Best Sellers</h3>

  @if($view_data['top3']->count() > 0)
    <div class="row row-cols-1 row-cols-md-3 g-4">
      @foreach($view_data['top3'] as $index => $piece)
        <div class="col">
          <div class="card h-100 shadow-sm">
            <div class="position-relative">
              <img src="{{ $piece->get_image_url() }}"
                   class="card-img-top"
                   alt="{{ $piece->get_name() }}"
                   style="height: 200px; object-fit: cover;">
              <span class="badge bg-dark position-absolute top-0 start-0 m-2">
                #{{ $index + 1 }}
              </span>
            </div>
            <div class="card-body">
              <h6 class="card-title">{{ $piece->get_name() }}</h6>
              <p class="card-text">
                <strong>Price:</strong> ${{ number_format($piece->get_price(), 0, ',', '.') }}<br>
                <strong>Units sold:</strong> {{ $piece->total_sold }}
              </p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @else
    <div class="alert alert-info">No sales data yet.</div>
  @endif
  </div>  
@endsection