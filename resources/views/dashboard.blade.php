@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card p-4 d-flex flex-row align-items-center gap-3">
            <div class="rounded-3 bg-primary bg-opacity-10 p-3">
                <i class="bi bi-building text-primary fs-3"></i>
            </div>
            <div>
                <p class="text-muted mb-0 small">Total Departments</p>
                <h2 class="fw-bold mb-0">{{ $departmentCount }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-4 d-flex flex-row align-items-center gap-3">
            <div class="rounded-3 bg-success bg-opacity-10 p-3">
                <i class="bi bi-person-gear text-success fs-3"></i>
            </div>
            <div>
                <p class="text-muted mb-0 small">Total Managers</p>
                <h2 class="fw-bold mb-0">{{ $managerCount }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-4 d-flex flex-row align-items-center gap-3">
            <div class="rounded-3 bg-warning bg-opacity-10 p-3">
                <i class="bi bi-people text-warning fs-3"></i>
            </div>
            <div>
                <p class="text-muted mb-0 small">Total Employees</p>
                <h2 class="fw-bold mb-0">{{ $employeeCount }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="card p-5 text-center">
    <i class="bi bi-people-fill text-primary fs-1 mb-3"></i>
    <h4 class="fw-bold">Welcome to EmpManager!</h4>
    <p class="text-muted">Use the sidebar to manage Departments, Managers and Employees.</p>
</div>
@endsection