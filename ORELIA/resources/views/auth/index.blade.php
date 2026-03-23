@extends('layouts.app')

@section('title', $title)

@section('content')
  <h1>{{ $title }}</h1>
  <p>Bienvenido, {{ $admin_name }}</p>

  <nav>
    <a href="{{ route('material.list') }}">Materiales</a>
    {{-- Aquí irán los links a los CRUDs del admin --}}
  </nav>

  <form method="POST" action="{{ route('login.logout') }}" style="margin-top: 20px;">
    @csrf
    <button type="submit">Cerrar sesión</button>
  </form>
@endsection