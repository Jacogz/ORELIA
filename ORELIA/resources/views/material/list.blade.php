@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="row">
  <div class="col-md-10">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h3 class="mb-0">Materials List</h3>
      </div>
      <div class="card-body">
        @if($viewData['materials']->count() > 0)
          <table class="table table-striped table-hover">
            <thead class="table-dark">
              <tr>
                <th>ID</th>
                <th>Name</th>
              </tr>
            </thead>
            <tbody>
              @foreach($viewData['materials'] as $material)
                <tr>
                  <td>
                    <a href="{{ route('material.show', $material->get_id()) }}" class="btn btn-sm btn-info">
                      {{ $material->get_id() }}
                    </a>
                  </td>
                  <td>{{ $material->get_name() }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @else
          <div class="alert alert-info">
            No materials found. <a href="{{ route('material.create') }}">Create one</a>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection