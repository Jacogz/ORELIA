@extends('layouts.app')

@section('title', $view_data['title'])

@section('content')
<div class="container mt-4">
  <h1>{{ $view_data['title'] }}</h1>

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">{{ __('users.user_information') }}</h5>

      <p><strong>{{ __('forms.id') }}:</strong> {{ $view_data['user']->get_id() }}</p>
      <p><strong>{{ __('forms.name') }}:</strong> {{ $view_data['user']->get_name() }}</p>
      <p><strong>{{ __('forms.last_name') }}:</strong> {{ $view_data['user']->get_last_name() }}</p>
      <p><strong>{{ __('forms.email') }}:</strong> {{ $view_data['user']->get_email() }}</p>
      <p><strong>{{ __('forms.role') }}:</strong> {{ $view_data['user']->get_role() }}</p>
      <p><strong>{{ __('forms.address') }}:</strong> {{ $view_data['user']->get_address() }}</p>
      <p><strong>{{ __('forms.created') }}:</strong> {{ $view_data['user']->created_at }}</p>
      <p><strong>{{ __('forms.updated') }}:</strong> {{ $view_data['user']->updated_at }}</p>
    </div>
  </div>

  <div class="mt-3">
    <a href="{{ route('users.index') }}" class="btn btn-secondary">{{ __('users.back_to_list') }}</a>
    <form action="{{ route('users.destroy', $view_data['user']->get_id()) }}" method="POST" style="display:inline;">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('users.confirm_delete_user') }}')">{{ __('users.delete_user') }}</button>
    </form>
  </div>
</div>
@endsection 