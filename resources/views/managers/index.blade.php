@extends('layouts.app')
@section('title', 'Managers')
@section('page-title', 'Managers')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>All Managers</span>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#mgrModal"
                onclick="openAddModal()">
            <i class="bi bi-plus-lg"></i> Add Manager
        </button>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead><tr>
                <th>#</th><th>Name</th><th>Department</th><th>Actions</th>
            </tr></thead>
            <tbody>
            @foreach($managers as $i => $mgr)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $mgr->name }}</td>
                    <td><span class="badge-dept">{{ $mgr->department->name ?? '-' }}</span></td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary"
                                onclick="openEditModal({{ $mgr->id }}, '{{ $mgr->name }}', {{ $mgr->department_id }})"
                                data-bs-toggle="modal" data-bs-target="#mgrModal">
                            <i class="bi bi-pencil"></i> Edit
                        </button>
                        <button class="btn btn-sm btn-outline-danger"
                                onclick="confirmDelete('{{ route('managers.destroy', $mgr->id) }}')">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="mgrModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="mgrForm" method="POST">
        @csrf
        <span id="mgrMethodField"></span>
        <div class="modal-header">
          <h5 class="modal-title" id="mgrTitle">Add Manager</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" id="mgrName" class="form-control" required>
          </div>
          <div>
            <label class="form-label">Department <span class="text-danger">*</span></label>
            <select name="department_id" id="mgrDept" class="form-select" required>
              <option value="">Select Department</option>
              @foreach($departments as $dept)
                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<form id="deleteForm" method="POST" style="display:none">@csrf @method('DELETE')</form>
@endsection

@push('scripts')
<script>
function openAddModal() {
    document.getElementById('mgrTitle').textContent = 'Add Manager';
    document.getElementById('mgrName').value = '';
    document.getElementById('mgrDept').value = '';
    document.getElementById('mgrForm').action = '{{ route("managers.store") }}';
    document.getElementById('mgrMethodField').innerHTML = '';
}
function openEditModal(id, name, deptId) {
    document.getElementById('mgrTitle').textContent = 'Edit Manager';
    document.getElementById('mgrName').value = name;
    document.getElementById('mgrDept').value = deptId;
    document.getElementById('mgrForm').action = '/managers/' + id;
    document.getElementById('mgrMethodField').innerHTML = '@method("PUT")';
}
function confirmDelete(url) {
    Swal.fire({ title: 'Are you sure?', text: 'This manager will be deleted!', icon: 'warning',
        showCancelButton: true, confirmButtonColor: '#ef4444', confirmButtonText: 'Yes, Delete'
    }).then(r => { if (r.isConfirmed) { document.getElementById('deleteForm').action = url; document.getElementById('deleteForm').submit(); }});
}
</script>
@endpush