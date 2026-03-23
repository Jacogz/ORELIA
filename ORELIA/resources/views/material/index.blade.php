@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $viewData['title'] }}</h1>

  <a href="{{ route('materials.create') }}" class="btn btn-primary mb-3">Create Material</a>

  @if($viewData['materials']->count() > 0)
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Type</th>
          <th>Description</th>
          <th>Color</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($viewData['materials'] as $material)
        <tr>
          <td>{{ $material->id }}</td>
          <td>{{ $material->name }}</td>
          <td>{{ $material->type }}</td>
          <td>{{ $material->description }}</td>
          <td>{{ $material->color }}</td>
          <td>
            <a href="{{ route('materials.show', $material->id) }}" class="btn btn-info btn-sm">View</a>
            <form action="{{ route('materials.destroy', $material->id) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm"
                onclick="return confirm('Are you sure?')">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <div class="alert alert-info">No materials found. <a href="{{ route('materials.create') }}">Create one</a></div>
  @endif
</div>
@endsection