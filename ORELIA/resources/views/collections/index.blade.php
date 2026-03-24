@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $viewData['title'] }}</h1>

  @if($viewData['collections']->count() > 0)
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Creation Date</th>
          <th>Action</th>
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
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <div class="alert alert-info">No collections found.</div>
  @endif
</div>
@endsection
