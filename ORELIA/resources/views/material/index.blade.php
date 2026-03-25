@extends('layouts.app')

@section('title', $view_data['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $view_data['title'] }}</h1>

  @if($view_data['materials']->count() > 0)
    <table class="table table-striped">
      <thead>
        <tr>
          <th>{{ __('forms.id') }}</th>
          <th>{{ __('forms.name') }}</th>
          <th>{{ __('forms.type') }}</th>
          <th>{{ __('forms.description') }}</th>
          <th>{{ __('forms.color') }}</th>
          <th>{{ __('materials.action') }}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($view_data['materials'] as $material)
        <tr>
          <td>{{ $material->get_id() }}</td>
          <td>{{ $material->get_name() }}</td>
          <td>{{ $material->get_type() }}</td>
          <td>{{ $material->get_description() }}</td>
          <td>{{ $material->get_color() }}</td>

          <td>
            <a href="{{ route('materials.show', $material->get_id()) }}" class="btn btn-info btn-sm">{{ __('actions.view') }}</a>
          <tr>
        @endforeach
      </tbody>
    </table>
  @else
    <div class="alert alert-info">{{ __('materials.no_materials_found') }}</div>
  @endif
</div>
@endsection
