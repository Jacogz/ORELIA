@extends('layouts.app')

@section('title', $view_data['title'])

@section('content')
<div class="container mt-4">
    <h1>{{ $view_data['title'] }}</h1>

    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">{{ __('users.create_user') }}</a>

    @if($view_data['users']->count() > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ __('forms.id') }}</th>
                    <th>{{ __('forms.name') }}</th>
                    <th>{{ __('forms.last_name') }}</th>
                    <th>{{ __('forms.email') }}</th>
                    <th>{{ __('forms.role') }}</th>
                    <th>{{ __('materials.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($view_data['users'] as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">{{ __('actions.view') }}</a>
                            <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display:inline;">
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
        <div class="alert alert-info">{{ __('users.no_users_found') }} <a href="{{ route('admin.users.create') }}">{{ __('users.create_one') }}</a></div>
    @endif
</div>
@endsection