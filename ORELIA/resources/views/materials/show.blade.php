@extends('layouts.app')

@section('title', $view_data['title'])

@section('content')
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h3 class="mb-0">{{ $view_data['material']->get_name() }}</h3>
      </div>
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label fw-bold">{{ __('forms.id') }}:</label>
            <p class="text-muted">{{ $view_data['material']->get_id() }}</p>
          </div>
          <div class="col-md-6">
            <label class="form-label fw-bold">{{ __('forms.name') }}:</label>
            <p class="text-muted">{{ $view_data['material']->get_name() }}</p>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label fw-bold">{{ __('forms.type') }}:</label>
            <p class="text-muted">{{ $view_data['material']->get_type() }}</p>
          </div>
          <div class="col-md-6">
            <label class="form-label fw-bold">{{ __('forms.color') }}:</label>
            <p class="text-muted">{{ $view_data['material']->get_color() }}</p>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label fw-bold">{{ __('forms.description') }}:</label>
          <p class="text-muted">{{ $view_data['material']->get_description() }}</p>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label fw-bold">{{ __('forms.created') }}:</label>
            <p class="text-muted">{{ $view_data['material']->get_created_at() }}</p>
          </div>
          <div class="col-md-6">
            <label class="form-label fw-bold">{{ __('forms.updated') }}:</label>
            <p class="text-muted">{{ $view_data['material']->get_updated_at() }}</p>
          </div>
        </div>

        <div class="d-flex gap-2">
          <a href="{{ route('materials.index') }}" class="btn btn-secondary">{{ __('actions.back') }}</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection