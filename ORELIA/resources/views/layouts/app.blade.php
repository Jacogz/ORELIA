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
        
        * {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--bg-marfil);
            color: var(--text-taupe);
        }
        
        /* Navigation Bar Styling */
        .navbar {
            background: linear-gradient(135deg, var(--primary-rosa) 0%, #f0c8d8 100%);
            box-shadow: 0 4px 20px rgba(212, 165, 165, 0.15);
            border-bottom: 2px solid var(--secondary-oro);
        }
        
        .navbar-brand {
            color: var(--text-taupe) !important;
            font-weight: 700;
            letter-spacing: 1px;
            font-size: 1.3rem;
        }
        
        /* Navigation Links */
        .nav-link {
            color: var(--text-taupe) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .nav-link:hover {
            color: var(--secondary-oro) !important;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--secondary-oro);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        /* Card Container Styling */
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(212, 165, 165, 0.12);
            background: white;
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 35px rgba(212, 165, 165, 0.2);
        }
        
        /* Card Header */
        .card-header {
            background: linear-gradient(135deg, var(--primary-rosa) 0%, #f0c8d8 100%);
            border: none;
            border-radius: 16px 16px 0 0 !important;
            font-weight: 700;
            color: var(--text-taupe);
            letter-spacing: 0.5px;
        }
        
        .card-body {
            padding: 2rem;
        }
        
        /* Button Base Styling */
        .btn {
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-size: 0.85rem;
        }
        
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(212, 165, 165, 0.25);
        }
        
        /* Primary Button - Rose Color */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-rosa) 0%, var(--rosa-oscuro) 100%);
            color: var(--text-taupe);
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, var(--rosa-oscuro) 0%, #c9a0a0 100%);
            color: var(--text-taupe);
        }
        
        /* Secondary Button - Taupe Color */
        .btn-secondary {
            background: var(--text-taupe);
            color: white;
        }
        
        .btn-secondary:hover {
            background: #7a7470;
            color: white;
        }
        
        /* Danger Button - Dark Rose */
        .btn-danger {
            background: var(--rosa-oscuro);
            color: white;
        }
        
        .btn-danger:hover {
            background: #c9a0a0;
            color: white;
        }
        
        /* Info Button - Gold Color */
        .btn-info {
            background: var(--secondary-oro);
            color: white;
        }
        
        .btn-info:hover {
            background: #c9a878;
            color: white;
        }
        
        /* Table Styling */
        .table {
            border-collapse: collapse;
            background: white;
        }
        
        .table thead {
            background: linear-gradient(135deg, var(--primary-rosa) 0%, #f0c8d8 100%);
            color: var(--text-taupe);
            font-weight: 700;
        }
        
        .table thead th {
            border: none;
            border-bottom: 2px solid var(--secondary-oro);
            padding: 1.2rem;
            letter-spacing: 0.5px;
        }
        
        .table tbody tr {
            border-bottom: 1px solid #f0e5ec;
            transition: all 0.2s ease;
        }
        
        .table tbody tr:hover {
            background-color: var(--rosa-claro);
        }
        
        .table tbody td {
            padding: 1.2rem;
            vertical-align: middle;
        }
        
        /* Alert Messages */
        .alert {
            border: none;
            border-radius: 12px;
            border-left: 4px solid var(--secondary-oro);
            font-weight: 500;
        }
        
        .alert-success {
            background-color: #f0fdf4;
            color: #166534;
        }
        
        .alert-danger {
            background-color: #fef2f2;
            color: #991b1b;
        }
        
        .alert-warning {
            background-color: #fffbeb;
            color: #92400e;
        }
        
        .alert-dismissible .btn-close {
            color: var(--text-taupe);
        }
        
        /* Form Controls */
        .form-control,
        .form-control:focus {
            border: 2px solid #f0e5ec;
            border-radius: 8px;
            padding: 0.7rem 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-rosa);
            box-shadow: 0 0 0 0.2rem rgba(245, 213, 224, 0.25);
            background-color: var(--rosa-claro);
        }
        
        /* Form Labels */
        .form-label {
            font-weight: 600;
            color: var(--text-taupe);
            letter-spacing: 0.3px;
            margin-bottom: 0.6rem;
        }
        
        /* Error Messages */
        .text-danger {
            color: #c9a0a0 !important;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        /* Links Styling */
        a {
            color: var(--rosa-oscuro);
            text-decoration: none;
            transition: all 0.2s ease;
        }
        
        a:hover {
            color: var(--secondary-oro);
            text-decoration: underline;
        }
        
        /* Headings */
        h1, h2, h3 {
            color: var(--text-taupe);
            font-weight: 700;
            letter-spacing: 0.5px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('material.index') }}">Material Workshop</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link text-white" href="{{ route('material.create') }}">Create</a>
                <a class="nav-link text-white" href="{{ route('material.list') }}">List</a>
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