<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
    <title>@yield('title', 'Material Workshop')</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark py-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('pieces.index') }}">ORELIA</a>

            <div class="d-flex align-items-center ms-auto">
                <a class="nav-link" href="{{ route('materials.index') }}">Catalog</a>
                <a class="nav-link" href="{{ route('collections.index') }}">Collections</a>
                <a class="nav-link" href="{{ route('pieces.index') }}">Pieces</a>
                <a class="nav-link" href="{{ route('orders.index') }}">Orders</a>
                <a class="nav-link" href="{{ route('orderitems.index') }}">Order Items</a>

                @auth
                    @if(Auth::user()->get_role() === 'admin')
                        <a class="nav-link" href="{{ route('admin.index') }}">Admin Panel</a>
                    @endif

                    <span class="me-3">Hola, {{ Auth::user()->get_name() }}</span>
                    <form action="{{ route('users.logout') }}" method="POST" class="mb-0">
                        @csrf
                        <button type="submit" class="btn btn-secondary btn-sm">Cerrar Sesion</button>
                    </form>
                @endauth

                @guest
                    <a class="btn btn-primary btn-sm ms-2" href="{{ route('users.login') }}">Login</a>
                @endguest
            </div>
        </div>
    </nav>

    <div class="container my-4">
        @if($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success:</strong> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error:</strong> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Validation Errors:</strong>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
