@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $viewData['title'] }}</h1>

  <a href="{{ route('collections.create') }}" class="btn btn-primary mb-3">Create Collection</a>

  @if($viewData['collections']->count() > 0)
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Creation Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($viewData['collections'] as $collection)
          <tr>
            <td>{{ $collection->get_id() }}</td>
            <td>{{ $collection->get_name() }}</td>
            <td>{{ $collection->get_creation_date() }}</td>
            <td>
              <a href="{{ route('collections.show', $collection->get_id()) }}" class="btn btn-info btn-sm">View</a>
              <form action="{{ route('collections.destroy', $collection->get_id()) }}" method="POST" style="display:inline;">
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
    <div class="alert alert-info">No collections found. <a href="{{ route('collections.create') }}">Create one</a></div>
  @endif
</div>
@endsection
