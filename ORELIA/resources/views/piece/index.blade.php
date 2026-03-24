@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $viewData['title'] }}</h1>

  <a href="{{ route('pieces.create') }}" class="btn btn-primary mb-3">Create Piece</a>

  @if($viewData['pieces']->count() > 0)
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Price</th>
          <th>Stock</th>
          <th>Collection ID</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($viewData['pieces'] as $piece)
          <tr>
            <td>{{ $piece->get_id() }}</td>
            <td>{{ $piece->get_name() }}</td>
            <td>{{ $piece->get_price() }}</td>
            <td>{{ $piece->get_stock() }}</td>
            <td>{{ $piece->get_collection_id() }}</td>
            <td>
              <a href="{{ route('pieces.show', $piece->get_id()) }}" class="btn btn-info btn-sm">View</a>
              <form action="{{ route('pieces.destroy', $piece->get_id()) }}" method="POST" style="display:inline;">
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
    <div class="alert alert-info">No pieces found. <a href="{{ route('pieces.create') }}">Create one</a></div>
  @endif
</div>
@endsection
