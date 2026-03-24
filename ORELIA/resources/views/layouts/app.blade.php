<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <title>@yield('title', 'Material Workshop')</title>

    <style>
        :root {
            --primary-rosa: #F5D5E0;
            --secondary-oro: #D4AF8F;
            --bg-marfil: #FAF8F3;
            --text-taupe: #8B8680;
            --rosa-oscuro: #D4A5A5;
            --rosa-claro: #FBE8EF;
        }

        * { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: var(--bg-marfil); color: var(--text-taupe); }
        .navbar { background: linear-gradient(135deg, var(--primary-rosa) 0%, #f0c8d8 100%); box-shadow: 0 4px 20px rgba(212, 165, 165, 0.15); border-bottom: 2px solid var(--secondary-oro); }
        .navbar-brand { color: var(--text-taupe) !important; font-weight: 700; letter-spacing: 1px; font-size: 1.3rem; }
        .nav-link { color: var(--text-taupe) !important; font-weight: 500; transition: all 0.3s ease; position: relative; margin-right: 10px; }
        .nav-link:hover { color: var(--secondary-oro) !important; }
        .nav-link::after { content: ''; position: absolute; bottom: -5px; left: 0; width: 0; height: 2px; background: var(--secondary-oro); transition: width 0.3s ease; }
        .nav-link:hover::after { width: 100%; }
        .card { border: none; border-radius: 16px; box-shadow: 0 8px 25px rgba(212, 165, 165, 0.12); background: white; transition: all 0.3s ease; overflow: hidden; }
        .card-header { background: linear-gradient(135deg, var(--primary-rosa) 0%, #f0c8d8 100%); border: none; border-radius: 16px 16px 0 0 !important; font-weight: 700; color: var(--text-taupe); letter-spacing: 0.5px; }
        .card-body { padding: 2rem; }
        .btn { border-radius: 10px; font-weight: 600; transition: all 0.3s ease; border: none; letter-spacing: 0.5px; text-transform: uppercase; font-size: 0.85rem; }
        .btn-primary { background: linear-gradient(135deg, var(--primary-rosa) 0%, var(--rosa-oscuro) 100%); color: var(--text-taupe); }
        .btn-secondary { background: var(--text-taupe); color: white; }
        .btn-danger { background: var(--rosa-oscuro); color: white; }
        .btn-info { background: var(--secondary-oro); color: white; }
        .table { border-collapse: collapse; background: white; }
        .table thead { background: linear-gradient(135deg, var(--primary-rosa) 0%, #f0c8d8 100%); color: var(--text-taupe); font-weight: 700; }
        .table tbody tr { border-bottom: 1px solid #f0e5ec; transition: all 0.2s ease; }
        .table tbody tr:hover { background-color: var(--rosa-claro); }
        .alert { border: none; border-radius: 12px; border-left: 4px solid var(--secondary-oro); font-weight: 500; }
        .form-control, .form-control:focus { border: 2px solid #f0e5ec; border-radius: 8px; padding: 0.7rem 1rem; }
        .form-label { font-weight: 600; color: var(--text-taupe); letter-spacing: 0.3px; margin-bottom: 0.6rem; }
        .text-danger { color: #c9a0a0 !important; font-size: 0.85rem; font-weight: 500; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark py-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home.index') }}">ORELIA</a>

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
                    <form action="{{ route('login.logout') }}" method="POST" class="mb-0">
                        @csrf
                        <button type="submit" class="btn btn-secondary btn-sm">Cerrar Sesion</button>
                    </form>
                @endauth

                @guest
                    <a class="btn btn-primary btn-sm ms-2" href="{{ route('login.index') }}">Login</a>
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
