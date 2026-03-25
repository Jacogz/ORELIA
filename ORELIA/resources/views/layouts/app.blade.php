<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
    <title>@yield('title', __('navigation.default_title'))</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark py-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('pieces.index') }}">{{ __('navigation.app_name') }}</a>

            <div class="d-flex align-items-center ms-auto">
                <a class="nav-link" href="{{ route('materials.index') }}">{{ __('navigation.catalog') }}</a>
                <a class="nav-link" href="{{ route('collections.index') }}">{{ __('navigation.collections') }}</a>
                <a class="nav-link" href="{{ route('pieces.index') }}">{{ __('navigation.pieces') }}</a>
                <a class="nav-link" href="{{ route('orders.index') }}">{{ __('navigation.orders') }}</a>
                <a class="nav-link" href="{{ route('orderitems.index') }}">{{ __('navigation.order_items') }}</a>
                <a class="nav-link" href="{{ route('cart.index') }}">{{ __('navigation.shopping_cart') }}</a>
                <a class="nav-link" href="{{ route('history.index') }}">{{ __('navigation.history') }}</a>

                @auth
                    @if(Auth::user()->get_role() === 'admin')
                        <a class="nav-link" href="{{ route('admin.index') }}">{{ __('navigation.admin_panel') }}</a>
                    @endif

                    <span class="me-3">{{ __('messages.hello') }}, {{ Auth::user()->get_name() }}</span>
                    <form action="{{ route('users.logout') }}" method="POST" class="mb-0">
                        @csrf
                        <button type="submit" class="btn btn-secondary btn-sm">{{ __('messages.logout') }}</button>
                    </form>
                @endauth

                @guest
                    <a class="btn btn-primary btn-sm ms-2" href="{{ route('users.login') }}">{{ __('messages.login') }}</a>
                @endguest
            </div>
        </div>
    </nav>

    <div class="container my-4">
        @if($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ __('messages.success') }}:</strong> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('messages.close') }}"></button>
            </div>
        @endif

        @if($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ __('messages.error') }}:</strong> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('messages.close') }}"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{ __('messages.validation_errors') }}:</strong>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('messages.close') }}"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
