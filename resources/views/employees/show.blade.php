@extends('layouts.app')
@section('title', $employee->full_name)
@section('page-title', 'Employee Details')

@section('content')
<div class="card" style="max-width:700px">
    <div class="card-header d-flex justify-content-between align-items-center">
        <a href="{{ route('employees.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-primary">
            <i class="bi bi-pencil"></i> Edit
        </a>
    </div>
    <div class="card-body">
        <div class="d-flex align-items-center gap-3 mb-4 pb-4 border-bottom">
            <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center text-primary fw-bold fs-3"
                 style="width:64px;height:64px;flex-shrink:0">
                {{ strtoupper(substr($employee->full_name, 0, 1)) }}
            </div>
            <div>
                <h4 class="fw-bold mb-0">{{ $employee->full_name }}</h4>
                <span class="text-muted small">{{ $employee->employee_code }}</span>
            </div>
        </div>
        <div class="row g-4">
            @foreach([
                ['Department',   $employee->department->name ?? '-'],
                ['Manager',      $employee->manager->name ?? 'N/A'],
                ['Joining Date', $employee->joining_date?->format('d/m/Y')],
                ['Email',        $employee->email],
                ['Phone',        $employee->phone ?? 'N/A'],
            ] as [$label, $value])
            <div class="col-md-6">
                <p class="text-muted small mb-0 text-uppercase fw-semibold">{{ $label }}</p>
                <p class="fw-medium mb-0">{{ $value }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection