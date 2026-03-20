<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'EmpManager')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- Flatpickr date picker -->
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">

    <style>
        body { background: #f1f5f9; }
        .sidebar { width: 260px; min-height: 100vh; background: #1e293b; position: fixed; top: 0; left: 0; z-index: 100; }
        .sidebar .brand { padding: 20px 24px; border-bottom: 1px solid #334155; }
        .sidebar .brand h5 { color: #38bdf8; font-weight: 700; margin: 0; font-size: 1.2rem; }
        .sidebar .nav-link { color: #94a3b8; padding: 10px 20px; border-radius: 8px; margin: 2px 8px; display: flex; align-items: center; gap: 10px; font-size: 0.9rem; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: #0f172a; color: #38bdf8; }
        .sidebar .nav-link i { font-size: 1rem; }
        .main-content { margin-left: 260px; padding: 24px; min-height: 100vh; }
        .topbar { background: white; border-radius: 12px; padding: 14px 24px; margin-bottom: 24px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 1px 3px rgba(0,0,0,0.08); }
        .topbar h4 { margin: 0; font-size: 1.1rem; font-weight: 600; color: #1e293b; }
        .card { border: none; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); }
        .card-header { background: white; border-bottom: 1px solid #e2e8f0; border-radius: 12px 12px 0 0 !important; padding: 16px 20px; font-weight: 600; }
        .btn-primary { background: #3b82f6; border-color: #3b82f6; }
        .btn-primary:hover { background: #2563eb; border-color: #2563eb; }
        .table th { font-size: 0.78rem; text-transform: uppercase; color: #64748b; font-weight: 600; background: #f8fafc; }
        .badge-dept { background: #eff6ff; color: #3b82f6; padding: 3px 10px; border-radius: 20px; font-size: 0.78rem; }
        .modal-header { border-bottom: 1px solid #e2e8f0; }
        .form-label { font-size: 0.875rem; font-weight: 500; color: #374151; }
        .form-control, .form-select { border-color: #d1d5db; font-size: 0.9rem; }
        .form-control:focus, .form-select:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,0.1); }
        .alert { border-radius: 10px; }
    </style>
    @stack('styles')
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="brand">
        <h5><i class="bi bi-people-fill me-2"></i>EmpManager</h5>
    </div>
    <nav class="mt-3">
        <a href="{{ route('dashboard') }}"
           class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a href="{{ route('departments.index') }}"
           class="nav-link {{ request()->routeIs('departments.*') ? 'active' : '' }}">
            <i class="bi bi-building"></i> Departments
        </a>
        <a href="{{ route('managers.index') }}"
           class="nav-link {{ request()->routeIs('managers.*') ? 'active' : '' }}">
            <i class="bi bi-person-gear"></i> Managers
        </a>
        <a href="{{ route('employees.index') }}"
           class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Employees
        </a>
    </nav>
</div>

<!-- Main Content -->
<div class="main-content">
    <div class="topbar">
        <h4>@yield('page-title', 'Dashboard')</h4>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-danger">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@stack('scripts')
</body>
</html>