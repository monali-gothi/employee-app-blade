<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Full Name <span class="text-danger">*</span></label>
        <input type="text" name="full_name"
               value="{{ old('full_name', $employee->full_name ?? '') }}"
               class="form-control @error('full_name') is-invalid @enderror">
        @error('full_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Employee Code <span class="text-danger">*</span></label>
        <input type="text" name="employee_code"
               value="{{ old('employee_code', $employee->employee_code ?? '') }}"
               class="form-control @error('employee_code') is-invalid @enderror">
        @error('employee_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Department <span class="text-danger">*</span></label>
        <select name="department_id" class="form-select @error('department_id') is-invalid @enderror">
            <option value="">Select Department</option>
            @foreach($departments as $d)
                <option value="{{ $d->id }}"
                    {{ old('department_id', $employee->department_id ?? '') == $d->id ? 'selected' : '' }}>
                    {{ $d->name }}
                </option>
            @endforeach
        </select>
        @error('department_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Manager</label>
        <select name="manager_id" class="form-select">
            <option value="">Select Manager</option>
            @foreach($managers as $m)
                <option value="{{ $m->id }}"
                    {{ old('manager_id', $employee->manager_id ?? '') == $m->id ? 'selected' : '' }}>
                    {{ $m->name }} ({{ $m->department->name ?? '' }})
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Joining Date <span class="text-danger">*</span></label>
        <input type="text" name="joining_date" id="joiningDate"
               value="{{ old('joining_date', isset($employee) ? $employee->joining_date?->format('Y-m-d') : '') }}"
               class="form-control @error('joining_date') is-invalid @enderror"
               placeholder="Select date">
        @error('joining_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Email Address <span class="text-danger">*</span></label>
        <input type="email" name="email"
               value="{{ old('email', $employee->email ?? '') }}"
               class="form-control @error('email') is-invalid @enderror">
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Phone Number</label>
        <input type="text" name="phone"
               value="{{ old('phone', $employee->phone ?? '') }}"
               class="form-control">
    </div>
    <div class="col-12 d-flex gap-2 mt-2">
        <button type="submit" class="btn btn-primary">Save Employee</button>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</div>

@push('scripts')
<script>flatpickr('#joiningDate', { dateFormat: 'Y-m-d', allowInput: true });</script>
@endpush