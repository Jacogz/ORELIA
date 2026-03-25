@extends('layouts.app')

@section('title', $view_data['title'])

@section('content')
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card shadow-sm">
      <div class="card-header">
        <h3 class="mb-0">{{ __('actions.edit') }} {{ __('navigation.pieces') }}</h3>
      </div>
      <div class="card-body">
        <form action="{{ route('pieces.update', $view_data['piece']->get_id()) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label for="name" class="form-label">{{ __('forms.name') }}</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $view_data['piece']->get_name()) }}" required>
            @error('name')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="price" class="form-label">{{ __('forms.price') }}</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $view_data['piece']->get_price()) }}" min="0" required>
            @error('price')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="type" class="form-label">{{ __('forms.type') }}</label>
            <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{ old('type', $view_data['piece']->get_type()) }}" required>
            @error('type')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="image_url" class="form-label">{{ __('forms.image_url') }}</label>
            <input type="text" class="form-control @error('image_url') is-invalid @enderror" id="image_url" name="image_url" value="{{ old('image_url', $view_data['piece']->get_image_url()) }}" required>
            @error('image_url')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="stock" class="form-label">{{ __('forms.stock') }}</label>
            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', $view_data['piece']->get_stock()) }}" min="0" required>
            @error('stock')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="size" class="form-label">{{ __('forms.size') }}</label>
            <input type="text" class="form-control @error('size') is-invalid @enderror" id="size" name="size" value="{{ old('size', $view_data['piece']->get_size()) }}" required>
            @error('size')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="weight" class="form-label">{{ __('forms.weight') }}</label>
            <input type="number" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" value="{{ old('weight', $view_data['piece']->get_weight()) }}" min="0" required>
            @error('weight')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="collection_id" class="form-label">{{ __('forms.collection_id') }}</label>
            <input type="number" class="form-control @error('collection_id') is-invalid @enderror" id="collection_id" name="collection_id" value="{{ old('collection_id', $view_data['piece']->get_collection_id()) }}" min="1" required>
            @error('collection_id')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
          </div>

          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">{{ __('actions.update') }}</button>
            <a href="{{ route('pieces.show', $view_data['piece']->get_id()) }}" class="btn btn-secondary">{{ __('actions.cancel') }}</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
