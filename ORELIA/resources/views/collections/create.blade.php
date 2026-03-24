@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $viewData['title'] }}</h1>

  <form action="{{ route('collections.store') }}" method="POST" class="card p-4">
    @csrf

    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
      @error('name')
        <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="creation_date" class="form-label">Creation Date</label>
      <input type="date" class="form-control @error('creation_date') is-invalid @enderror" id="creation_date" name="creation_date" value="{{ old('creation_date') }}" required>
      @error('creation_date')
        <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>

    <div class="d-flex gap-2">
      <button type="submit" class="btn btn-primary">Save</button>
      <a href="{{ route('collections.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
  </form>
</div>
@endsection
