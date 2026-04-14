<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Style -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            font-size: 12px;
            background-color: #f3f4f6; /* Soft light gray for minimal look */
            color: #1f2937;
        }
        form, .form-control, .form-select, .form-check-input, .form-check-label, .form-label, .form-text, .form-check-input, .form-check-label {
            font-size: 12px;
        }
        button, .btn {
            font-size: 12px;
        }
        .navbar {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.95) !important;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .navbar-brand {
            font-weight: 600;
            letter-spacing: -0.5px;
        }
        .nav-link {
            font-weight: 500;
            color: #4b5563 !important;
            transition: color 0.2s;
        }
        .nav-link:hover {
            color: #1f2937 !important;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }
        .card-header {
            background-color: transparent;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            font-weight: 600;
            padding: 1.25rem 1.5rem;
        }
        .form-control {
            border-radius: 8px;
            border: 1px solid #d1d5db;
            padding: 0.6rem 1rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-control:focus {
            border-color: #6b7280;
            box-shadow: 0 0 0 3px rgba(107, 114, 128, 0.1);
        }
        .btn-primary {
            background-color: #1f2937;
            border-color: #1f2937;
            border-radius: 8px;
            font-weight: 500;
            padding: 0.6rem 1.5rem;
            transition: background-color 0.2s, transform 0.1s;
        }
        .btn-primary:hover {
            background-color: #374151;
            border-color: #374151;
        }
        .btn-primary:active {
            transform: scale(0.98);
        }
        .btn-link {
            text-decoration: none;
            color: #4b5563;
        }
        .btn-link:hover {
            color: #1f2937;
            text-decoration: underline;
        }
    </style>
</head>
<body  oncontextmenu="return false;">
    <div id="app">
        @if(!request()->routeIs('login') && !request()->routeIs('register') && !request()->routeIs('password.*'))
        <nav class="navbar navbar-expand-md navbar-light sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'DKT Parklaring') }}
                </a>
                <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto align-items-center">
                        <!-- Authentication Links -->
                        @guest

                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end border-0 shadow-sm" aria-labelledby="navbarDropdown" style="border-radius: 12px;">
                                    <a class="dropdown-item py-2" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @endif

        <main class="py-5">
            @yield('content')
        </main>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('contextmenu', (e) => {
            e.preventDefault(); // Prevents the default context menu from appearing
        }); 
        document.onkeydown = function(e) {
        // Disable F12
        if (event.keyCode == 123) {
            return false;
        }
        // Disable Ctrl+Shift+I, J, C, U
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
            return false;
        }
        };
    </script>

</body>
</html>
