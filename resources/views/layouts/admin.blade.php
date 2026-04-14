<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Parklaring</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        body { 
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6; 
            color: #1f2937;
        }

        /* Sweet Alert */
        .swal2-title {
            font-size: 20px !important;
            font-family: 'Inter', sans-serif !important;
        }
        .swal2-content {
            font-size: 14px !important;
            font-family: 'Inter', sans-serif !important;
        }
        .swal2-confirm, .swal2-cancel {
            font-size: 14px !important;
        }
        
        /* Sidebar styling for desktop */
        .sidebar { 
            min-height: 100vh; 
            background-color: #ffffff; 
            border-right: 1px solid rgba(0,0,0,0.05);
            padding-top: 20px;
        }
        .sidebar-brand {
            font-weight: 700;
            color: #1f2937;
            font-size: 1.25rem;
            letter-spacing: -0.5px;
            margin-bottom: 2rem;
            display: block;
        }
        .sidebar-link { 
            color: #6b7280; 
            text-decoration: none; 
            padding: 12px 20px; 
            display: flex;
            align-items: center;
            border-radius: 8px;
            margin: 0 10px 5px 10px;
            font-weight: 500;
            transition: all 0.2s;
        }
        .sidebar-link:hover { 
            background-color: #f3f4f6; 
            color: #1f2937; 
        }
        .sidebar-link.active { 
            background-color: #e5e7eb; 
            color: #1f2937; 
            font-weight: 600;
        }
        .sidebar-link i {
            margin-right: 10px;
            font-size: 1.1rem;
        }
        
        /* Content area */
        .content { 
            padding: 24px; 
        }
        .navbar-top {
            background-color: transparent;
            padding: 0 0 24px 0;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            margin-bottom: 24px;
        }
        
        /* Typography overrides */
        h1, h2, h3, h4, h5, h6 { font-weight: 600; letter-spacing: -0.5px; }
        
        /* Card enhancements */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            background: #fff;
        }
        .card-header {
            background-color: transparent;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            font-weight: 600;
            padding: 1.25rem 1.5rem;
        }
        .btn-primary {
            background-color: #1f2937;
            border-color: #1f2937;
            border-radius: 8px;
            font-weight: 500;
        }
        .btn-primary:hover {
            background-color: #374151;
            border-color: #374151;
        }
        .table {
            color: #374151;
            font-size: 12px;
        }
        .table th, li {
            font-size: 12px;
        }
        .table td {
            font-size: 12px;
        }
        .table tr {
            font-size: 12px;
        }
        .table th {
            font-size: 12px;
        }
        .table td {
            font-size: 12px;
        }
        .btn {
            font-size: 11px;
        }
        h2 {
            font-size: 18px;
        }
        h3 {
            font-size: 16px;
        }
        h4 {
            font-size: 14px;
        }
        form {
            font-size: 12px;
        }
        label {
            font-size: 12px;
        }
        input {
            font-size: 12px;
        }
        select {
            font-size: 12px;
        }
        textarea {
            font-size: 12px;
        }
        .form-control {
            font-size: 12px;
        }
        .form-select {
            font-size: 12px;
        }
        .form-label {
            font-size: 10px;
            color: #9f9f9fff;
            font-weight: 600;
        }
        .form-check-label {
            font-size: 12px;
        }
        .form-check-input {
            font-size: 12px;
        }
        .form-check-input:checked {
            background-color: #1f2937;
            border-color: #1f2937;
        }
        .form-check-input:focus {
            background-color: #1f2937;
            border-color: #1f2937;
        }
        .form-check-input:active {
            background-color: #1f2937;
            border-color: #1f2937;
        }
        .form-check-input:hover {   
            background-color: #1f2937;
            border-color: #1f2937;
        }
        .form-check-input:disabled {
            background-color: #1f2937;
            border-color: #1f2937;
        }
        .form-check-input:disabled:checked {
            background-color: #1f2937;
            border-color: #1f2937;
        }
        .form-check-input:disabled:hover {
            background-color: #1f2937;
            border-color: #1f2937;
        }
        .form-check-input:disabled:active {
            background-color: #1f2937;
            border-color: #1f2937;
        }
        .form-check-input:disabled:focus {
            background-color: #1f2937;
            border-color: #1f2937;
        }
        .form-check-input:disabled:active {
            background-color: #1f2937;
            border-color: #1f2937;
        }
        .form-check-input:disabled:hover {
            background-color: #1f2937;
            border-color: #1f2937;
        }
        .form-check-input:disabled:checked:hover {
            background-color: #1f2937;
            border-color: #1f2937;
        }
        .form-check-input:disabled:checked:active {
            background-color: #1f2937;
            border-color: #1f2937;
        }
        .form-check-input:disabled:checked:focus {
            background-color: #1f2937;
            border-color: #1f2937;
        }
        .form-check-input:disabled:checked:hover {
            background-color: #1f2937;
            border-color: #1f2937;
        }
        .form-check-input:disabled:checked:active {
            background-color: #1f2937;
            border-color: #1f2937;
        }
        .form-check-input:disabled:checked:focus {
            background-color: #1f2937;
            border-color: #1f2937;
        }
        .form-check-input:disabled:checked:hover {
            background-color: #1f2937;
            border-color: #1f2937;
        }
        .form-check-input:disabled:checked:active {
            background-color: #1f2937;
            border-color: #1f2937;
        }
        .form-check-input:disabled:checked:focus {
            background-color: #1f2937;
            border-color: #1f2937;
        }
        .form-check-input:disabled:checked:hover {
            background-color: #1f2937;
            border-color: #1f2937;
        }
        .form-check-input:disabled:checked:active {
            background-color: #1f2937;
            border-color: #1f2937;
        }
        .form-check-input:disabled:checked:focus {
            background-color: #1f2937;
            border-color: #1f2937;
        }
    </style>
</head>
<body>
    <div class="d-flex position-relative">
        
        <!-- Desktop Sidebar (hidden on mobile) -->
        <!-- <div class="d-none d-lg-flex flex-column sidebar" style="width: 280px; sticky-top">
            <div class="text-center px-4">
                <span class="sidebar-brand"><i class="bi bi-shield-lock-fill me-2 text-primary"></i>Admin Panel</span>
            </div>
            
            <a href="{{ url('/admin/parklaring') }}" class="sidebar-link active">
                <i class="bi bi-file-earmark-text"></i> Parklaring Data
            </a>
            
            <div class="mt-auto mb-4">
                <hr class="text-secondary mx-3">
                <form method="POST" action="{{ route('logout') }}" id="logout-form-desktop">
                    @csrf
                    <a href="#" onclick="document.getElementById('logout-form-desktop').submit();" class="sidebar-link text-danger mt-3">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </form>
            </div>
        </div> -->

        <!-- Main Content -->
        <div class="flex-grow-1 w-100">
            <div class="content">
                <!-- Top Navbar -->
                <nav class="navbar-top d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <button class="btn btn-light d-lg-none me-3 border-0 shadow-sm rounded-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas">
                            <i class="bi bi-list fs-5"></i>
                        </button>
                        <h4 class="mb-0 text-dark">DKT Parklaring Management V.1.0</h4>
                    </div>
                    <div class="d-flex align-items-center dropdown">
                        <button class="btn btn-light rounded-pill border-0 shadow-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle text-secondary me-1"></i>
                            <span class="fw-medium d-none d-sm-inline">{{ Auth::user()->name ?? 'Admin' }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm rounded-3 mt-2">
                            <li><h6 class="dropdown-header">Logged in as Admin</h6></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-default py-2" href="{{ url('/admin/setting') }}">
                                    <i class="bi bi-gear me-2"></i>Settings
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger py-2" href="#" onclick="document.getElementById('logout-form-mobile').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i>Sign out
                                </a>
                                <form method="POST" action="{{ route('logout') }}" id="logout-form-mobile" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </nav>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible shadow-sm border-0 fade show rounded-3" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
                
            </div>
        </div>
    </div>

    <!-- Mobile Sidebar Offcanvas -->
    <div class="offcanvas offcanvas-start border-0 shadow" tabindex="-1" id="sidebarOffcanvas" aria-labelledby="sidebarOffcanvasLabel">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title fw-bold" id="sidebarOffcanvasLabel">
                <i class="bi bi-shield-lock-fill me-2 text-primary"></i>Admin Panel
            </h5>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0 pt-3 d-flex flex-column">
            <a href="{{ url('/admin/parklaring') }}" class="sidebar-link active">
                <i class="bi bi-file-earmark-text"></i> Parklaring Data
            </a>
            
            <div class="mt-auto p-3 border-top">
                <a href="#" onclick="document.getElementById('logout-form-mobile').submit();" class="sidebar-link text-danger m-0">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('script')
</body>
</html>
