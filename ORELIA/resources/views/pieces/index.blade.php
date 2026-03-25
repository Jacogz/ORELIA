@extends('layouts.app')

@section('title', $view_data['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $view_data['title'] }}</h1>

  @if($view_data['pieces']->count() > 0)
    <table class="table table-striped">
      <thead>
        <tr>
          <th>{{ __('forms.id') }}</th>
          <th>{{ __('forms.name') }}</th>
          <th>{{ __('forms.price') }}</th>
          <th>{{ __('forms.stock') }}</th>
          <th>{{ __('forms.collection_id') }}</th>
          <th>{{ __('materials.action') }}</th>
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
              <a href="{{ route('pieces.show', $piece->get_id()) }}" class="btn btn-info btn-sm">{{ __('actions.view') }}</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <div class="alert alert-info">{{ __('pieces.no_pieces_found') }}</div>
  @endif
</div>
@endsection
