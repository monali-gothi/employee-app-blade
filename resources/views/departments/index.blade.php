@extends('layouts.app')
@section('title', 'Departments')
@section('page-title', 'Departments')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>All Departments</span>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#deptModal"
                onclick="openAddModal()">
            <i class="bi bi-plus-lg"></i> Add Department
        </button>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead><tr>
                <th>#</th><th>Name</th><th>Employees</th><th>Actions</th>
            </tr></thead>
            <tbody>
            @foreach($departments as $i => $dept)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $dept->name }}</td>
                    <td><span class="badge bg-primary">{{ $dept->employees_count ?? $dept->employees()->count() }}</span></td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary"
                                onclick="openEditModal({{ $dept->id }}, '{{ $dept->name }}')"
                                data-bs-toggle="modal" data-bs-target="#deptModal">
                            <i class="bi bi-pencil"></i> Edit
                        </button>
                        <button class="btn btn-sm btn-outline-danger"
                                onclick="confirmDelete('{{ route('departments.destroy', $dept->id) }}')">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add/Edit Modal -->
<div class="modal fade" id="deptModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="deptForm" method="POST">
        @csrf
        <span id="methodField"></span>
        <div class="modal-header">
          <h5 class="modal-title" id="modalTitle">Add Department</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <label class="form-label">Department Name <span class="text-danger">*</span></label>
          <input type="text" name="name" id="deptName" class="form-control" required>
          @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete Form -->
<form id="deleteForm" method="POST" style="display:none">
    @csrf @method('DELETE')
</form>
@endsection

@push('scripts')
<script>
function openAddModal() {
    document.getElementById('modalTitle').textContent = 'Add Department';
    document.getElementById('deptName').value = '';
    document.getElementById('deptForm').action = '{{ route("departments.store") }}';
    document.getElementById('methodField').innerHTML = '';
}
function openEditModal(id, name) {
    document.getElementById('modalTitle').textContent = 'Edit Department';
    document.getElementById('deptName').value = name;
    document.getElementById('deptForm').action = '/departments/' + id;
    document.getElementById('methodField').innerHTML = '@method("PUT")';
}
function confirmDelete(url) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'This department will be deleted!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        confirmButtonText: 'Yes, Delete',
        cancelButtonText: 'Cancel'
    }).then(result => {
        if (result.isConfirmed) {
            const form = document.getElementById('deleteForm');
            form.action = url;
            form.submit();
        }
    });
}
</script>
@endpush