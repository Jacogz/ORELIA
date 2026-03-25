@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $viewData['title'] }}</h1>

  @if($viewData['collections']->count() > 0)
    <table class="table table-striped">
      <thead>
        <tr>
          <th>{{ __('forms.id') }}</th>
          <th>{{ __('forms.name') }}</th>
          <th>{{ __('collections.creation_date') }}</th>
          <th>{{ __('materials.action') }}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($viewData['collections'] as $collection)
          <tr>
            <td>{{ $collection->get_id() }}</td>
            <td>{{ $collection->get_name() }}</td>
            <td>{{ $collection->get_creation_date() }}</td>
            <td>
              <a href="{{ route('collections.show', $collection->get_id()) }}" class="btn btn-info btn-sm">{{ __('actions.view') }}</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <div class="alert alert-info">{{ __('collections.no_collections_found') }}</div>
  @endif
</div>
@endsection
