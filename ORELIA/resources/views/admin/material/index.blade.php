@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $viewData['title'] }}</h1>

  <a href="{{ route('admin.materials.create') }}" class="btn btn-primary mb-3">Create Material</a>

  @if($viewData['materials']->count() > 0)
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Type</th>
          <th>Color</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($viewData['materials'] as $material)
          <tr>
            <td>{{ $material->get_id() }}</td>
            <td>{{ $material->get_name() }}</td>
            <td>{{ $material->get_type() }}</td>
            <td>{{ $material->get_color() }}</td>
            <td>
              <a href="{{ route('admin.materials.show', $material->get_id()) }}" class="btn btn-info btn-sm">View</a>
              <a href="{{ route('admin.materials.edit', $material->get_id()) }}" class="btn btn-secondary btn-sm">Edit</a>
              <form action="{{ route('admin.materials.destroy', $material->get_id()) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <div class="alert alert-info">No materials found.</div>
  @endif
</div>
@endsection
