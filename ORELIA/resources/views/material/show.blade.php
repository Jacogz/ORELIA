@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h3 class="mb-0">{{ $viewData['material']->get_name() }}</h3>
      </div>
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label fw-bold">ID:</label>
            <p class="text-muted">{{ $viewData['material']->get_id() }}</p>
          </div>
          <div class="col-md-6">
            <label class="form-label fw-bold">Name:</label>
            <p class="text-muted">{{ $viewData['material']->get_name() }}</p>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label fw-bold">Type:</label>
            <p class="text-muted">{{ $viewData['material']->get_type() }}</p>
          </div>
          <div class="col-md-6">
            <label class="form-label fw-bold">Color:</label>
            <p class="text-muted">{{ $viewData['material']->get_color() }}</p>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label fw-bold">Description:</label>
          <p class="text-muted">{{ $viewData['material']->get_description() }}</p>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label fw-bold">Created:</label>
            <p class="text-muted">{{ $viewData['material']->created_at }}</p>
          </div>
          <div class="col-md-6">
            <label class="form-label fw-bold">Updated:</label>
            <p class="text-muted">{{ $viewData['material']->updated_at }}</p>
          </div>
        </div>

        <div class="d-flex gap-2">
          <a href="{{ route('material.list') }}" class="btn btn-secondary">Back</a>
          <form method="POST" action="{{ route('material.destroy', $viewData['material']->get_id()) }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection