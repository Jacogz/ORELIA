@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div style="max-width: 400px; margin: 80px auto;">
    <h1>Login</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 16px;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.authenticate') }}">
        @csrf

        <div style="margin-bottom: 16px;">
            <label for="email">Correo electrónico</label><br>
            <input type="email" id="email" name="email"
                   value="{{ old('email') }}"
                   style="width: 100%; padding: 8px;" required>
        </div>

        <div style="margin-bottom: 16px;">
            <label for="password">Contraseña</label><br>
            <input type="password" id="password" name="password"
                   style="width: 100%; padding: 8px;" required>
        </div>

        <button type="submit" style="padding: 10px 24px;">Entrar</button>
    </form>
</div>
@endsection