@extends('layouts.app')

@section('title', $view_data['title'])

@section('content')
<div class="row">
  <div class="col-md-10">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h3 class="mb-0">Materials List</h3>
      </div>
      <div class="card-body">
        @if($view_data['materials']->count() > 0)
          <table class="table table-striped table-hover">
            <thead class="table-dark">
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($view_data['materials'] as $material)
                <tr>
                  <td>
                    <a href="{{ route('materials.show', $material->get_id()) }}" class="btn btn-sm btn-info">
                      {{ $material->get_id() }}
                    </a>
                  </td>
                  <td>{{ $material->get_name() }}</td>
                  <td>
                    <a href="{{ route('materials.show', $material->get_id()) }}" class="btn btn-info btn-sm">View</a>
                    <form action="{{ route('materials.delete', $material->get_id()) }}" method="POST" style="display:inline;">
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
          <div class="alert alert-info">
            No materials found. <a href="{{ route('materials.create') }}">Create one</a>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection