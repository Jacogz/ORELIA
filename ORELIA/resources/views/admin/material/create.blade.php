@extends('layouts.app')

@section('title', $view_data['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $view_data['title'] }}</h1>

  <form action="{{ route('admin.materials.store') }}" method="POST" class="card p-4">
    @csrf

    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
      @error('name')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label for="type" class="form-label">Type</label>
      <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{ old('type') }}" required>
      @error('type')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
      @error('description')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label for="color" class="form-label">Color</label>
      <input type="text" class="form-control @error('color') is-invalid @enderror" id="color" name="color" value="{{ old('color') }}" required>
      @error('color')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('admin.materials.index') }}" class="btn btn-secondary">Cancel</a>
  </form>
</div>
@endsection
