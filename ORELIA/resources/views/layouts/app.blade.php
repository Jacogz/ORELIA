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
            <!-- Logo -->
            <a class="navbar-brand fw-bold" href="{{ route('materials.index') }}">Material Workshop</a>

            <!-- Links y usuario -->
            <div class="d-flex align-items-center ms-auto">
                <a class="nav-link" href="{{ route('materials.index') }}">Materials</a>
                <a class="nav-link" href="{{ route('users.index') }}">Users</a>
                <a class="nav-link" href="{{ route('orderitems.index') }}">Order Items</a>

                @auth
                    <span class="me-3">Hello, {{ Auth::user()->get_name() }}</span>
                    <form action="{{ route('login.logout') }}" method="POST" class="mb-0">
                        @csrf
                        <button type="submit" class="btn btn-secondary btn-sm">Log Out</button>
                    </form>
                @endauth

                @guest
                    <a class="btn btn-primary btn-sm ms-2" href="{{ route('login.index') }}">Login</a>
                @endguest
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <!-- Success Message -->
        @if($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success:</strong> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Error Message -->
        @if($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error:</strong> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Validation Errors -->
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