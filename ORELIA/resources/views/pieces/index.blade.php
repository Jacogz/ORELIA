@extends('layouts.app')

@section('title', $view_data['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $view_data['title'] }}</h1>

  @if($view_data['pieces']->count() > 0)
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Price</th>
          <th>Stock</th>
          <th>Collection ID</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($view_data['pieces'] as $piece)
          <tr>
            <td>{{ $piece->get_id() }}</td>
            <td>{{ $piece->get_name() }}</td>
            <td>{{ $piece->get_price() }}</td>
            <td>{{ $piece->get_stock() }}</td>
            <td>{{ $piece->get_collection_id() }}</td>
            <td>
              <a href="{{ route('pieces.show', $piece->get_id()) }}" class="btn btn-info btn-sm">View</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <div class="alert alert-info">No pieces found.</div>
  @endif
</div>
@endsection
