@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card shadow-sm">
      <div class="card-body text-center">
        <h1 class="card-title mb-4">Welcome to Material Management</h1>

        <a href="{{ route('material.create') }}" class="btn btn-primary btn-lg me-2">
          Create Material
        </a>

        <a href="{{ route('material.list') }}" class="btn btn-secondary btn-lg">
          List Materials
        </a>
      </div>
    </div>
  </div>
</div>
@endsection