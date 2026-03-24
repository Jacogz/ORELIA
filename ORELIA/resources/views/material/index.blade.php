@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $viewData['title'] }}</h1>

  @if($viewData['materials']->count() > 0)
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Type</th>
          <th>Description</th>
          <th>Color</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($viewData['materials'] as $material)
        <tr>
          <td>{{ $material->get_id() }}</td>
          <td>{{ $material->get_name() }}</td>
          <td>{{ $material->get_type() }}</td>
          <td>{{ $material->get_description() }}</td>
          <td>{{ $material->get_color() }}</td>
          <td>
            <a href="{{ route('materials.show', $material->get_id()) }}" class="btn btn-info btn-sm">View</a>
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
