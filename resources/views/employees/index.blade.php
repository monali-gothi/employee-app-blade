@extends('layouts.app')
@section('title', 'Employees')
@section('page-title', 'Employees')

@section('content')
<!-- Filters -->
<div class="card mb-4">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-3">
                <input type="text" id="filterName" class="form-control" placeholder="Search by Name">
            </div>
            <div class="col-md-2">
                <select id="filterDept" class="form-select">
                    <option value="">All Departments</option>
                    @foreach($departments as $d)
                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select id="filterMgr" class="form-select">
                    <option value="">All Managers</option>
                    @foreach($managers as $m)
                        <option value="{{ $m->id }}">{{ $m->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="text" id="filterDateFrom" class="form-control" placeholder="Joining Date From">
            </div>
            <div class="col-md-2">
                <input type="text" id="filterDateTo" class="form-control" placeholder="To Date">
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>All Employees</span>
        <a href="{{ route('employees.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg"></i> Add Employee
        </a>
    </div>
    <div class="card-body">
        <table id="employeesTable" class="table table-hover w-100">
            <thead><tr>
                <th>Employee Name</th>
                <th>Code</th>
                <th>Department</th>
                <th>Manager</th>
                <th>Joining Date</th>
                <th>Actions</th>
            </tr></thead>
        </table>
    </div>
</div>

<form id="deleteForm" method="POST" style="display:none">@csrf @method('DELETE')</form>
@endsection

@push('scripts')
<script>
flatpickr('#filterDateFrom', { dateFormat: 'Y-m-d', allowInput: true });
flatpickr('#filterDateTo',   { dateFormat: 'Y-m-d', allowInput: true });

var table = $('#employeesTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '{{ route("employees.datatable") }}',
        data: function(d) {
            d.name          = $('#filterName').val();
            d.department_id = $('#filterDept').val();
            d.manager_id    = $('#filterMgr').val();
            d.date_from     = $('#filterDateFrom').val();
            d.date_to       = $('#filterDateTo').val();
        }
    },
    columns: [
        { data: 'full_name', render: function(data, type, row) {
            return '' + data + '';
        }},
        { data: 'employee_code' },
        { data: 'department_name' },
        { data: 'manager_name' },
        { data: 'joining_date_fmt' },
        { data: 'action', orderable: false, searchable: false },
    ],
    dom: '<"d-flex justify-content-between align-items-center mb-3"lf>rt<"d-flex justify-content-between align-items-center mt-3"ip>',
    language: { search: '', searchPlaceholder: 'Quick search...' }
});

// Re-fetch on filter change
$('#filterName').on('keyup', function() { table.ajax.reload(); });
$('#filterDept, #filterMgr').on('change', function() { table.ajax.reload(); });
$('#filterDateFrom, #filterDateTo').on('change', function() { table.ajax.reload(); });

// Delete button
$(document).on('click', '.delete-btn', function() {
    var id = $(this).data('id');
    Swal.fire({
        title: 'Are you sure?',
        text: 'This employee will be soft deleted!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        confirmButtonText: 'Yes, Delete',
        cancelButtonText: 'Cancel'
    }).then(function(result) {
        if (result.isConfirmed) {
            var form = document.getElementById('deleteForm');
            form.action = '/employees/' + id;
            form.submit();
        }
    });
});
</script>
@endpush