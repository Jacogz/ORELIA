@extends('layouts.app')

@section('title', $view_data['title'])

@section('content')
<div class="row">
  <div class="col-md-10">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h3 class="mb-0">{{ __('materials.materials_list') }}</h3>
      </div>
      <div class="card-body">
        @if($view_data['materials']->count() > 0)
          <table class="table table-striped table-hover">
            <thead class="table-dark">
              <tr>
                <th>{{ __('forms.id') }}</th>
                <th>{{ __('forms.name') }}</th>
                <th>{{ __('materials.actions') }}</th>
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
                    <a href="{{ route('materials.show', $material->get_id()) }}" class="btn btn-info btn-sm">{{ __('actions.view') }}</a>
                    <form action="{{ route('materials.delete', $material->get_id()) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('materials.confirm_delete') }}')">{{ __('actions.delete') }}</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @else
          <div class="alert alert-info">
            {{ __('materials.no_materials_found') }} <a href="{{ route('materials.create') }}">{{ __('materials.create_one') }}</a>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection