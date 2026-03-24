@extends('layouts.app')

@section('title', $view_data['title'])

@section('content')
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card shadow-sm">
      <div class="card-header">
        <h3 class="mb-0">Edit Material</h3>
      </div>
      <div class="card-body">
        <form action="{{ route('materials.update', $view_data['material']->get_id()) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="{{ old('name', $view_data['material']->get_name()) }}" required>
            @error('name')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <input type="text" class="form-control" id="type" name="type"
                   value="{{ old('type', $view_data['material']->get_type()) }}" required>
            @error('type')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $view_data['material']->get_description()) }}</textarea>
            @error('description')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="color" class="form-label">Color</label>
            <input type="text" class="form-control" id="color" name="color"
                   value="{{ old('color', $view_data['material']->get_color()) }}" required>
            @error('color')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
          </div>

          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('materials.show', $view_data['material']->get_id()) }}" class="btn btn-secondary">Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection