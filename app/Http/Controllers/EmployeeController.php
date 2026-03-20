<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Employee, Department, Manager};
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $departments = Department::latest()->get();
        $managers    = Manager::with('department')->latest()->get();
        return view('employees.index', compact('departments', 'managers'));
    }

    public function datatable(Request $request)
    {
        $query = Employee::with(['department', 'manager'])->select('employees.*');

        if ($request->filled('name'))
            $query->where('full_name', 'like', '%'.$request->name.'%');
        if ($request->filled('department_id'))
            $query->where('department_id', $request->department_id);
        if ($request->filled('manager_id'))
            $query->where('manager_id', $request->manager_id);
        if ($request->filled('date_from'))
            $query->whereDate('joining_date', '>=', $request->date_from);
        if ($request->filled('date_to'))
            $query->whereDate('joining_date', '<=', $request->date_to);

        return DataTables::of($query)
            ->addColumn('department_name', fn($e) => $e->department?->name ?? '-')
            ->addColumn('manager_name',    fn($e) => $e->manager?->name    ?? '-')
            ->addColumn('joining_date_fmt', fn($e) => $e->joining_date?->format('d/m/Y'))
            ->addColumn('action', function($e) {
                return '<a href="'.route('employees.show', $e->id).'" class="btn btn-sm btn-info">View</a> '
                     . '<a href="'.route('employees.edit', $e->id).'" class="btn btn-sm btn-primary">Edit</a> '
                     . '<button class="btn btn-sm btn-danger delete-btn" data-id="'.$e->id.'">Delete</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create() {
        $departments = Department::latest()->get();
        $managers    = Manager::with('department')->latest()->get();
        return view('employees.create', compact('departments', 'managers'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'full_name'     => 'required|max:150',
            'employee_code' => 'required|unique:employees|max:20',
            'department_id' => 'required|exists:departments,id',
            'manager_id'    => 'nullable|exists:managers,id',
            'joining_date'  => 'required|date',
            'email'         => 'required|email|unique:employees',
            'phone'         => 'nullable|max:20',
        ]);
        Employee::create($validated);
        return redirect()->route('employees.index')->with('success', 'Employee created.');
    }

    public function show(Employee $employee) {
        $employee->load('department', 'manager');
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee) {
        $departments = Department::latest()->get();
        $managers    = Manager::with('department')->latest()->get();
        return view('employees.edit', compact('employee', 'departments', 'managers'));
    }

    public function update(Request $request, Employee $employee) {
        $validated = $request->validate([
            'full_name'     => 'required|max:150',
            'employee_code' => 'required|max:20|unique:employees,employee_code,'.$employee->id,
            'department_id' => 'required|exists:departments,id',
            'manager_id'    => 'nullable|exists:managers,id',
            'joining_date'  => 'required|date',
            'email'         => 'required|email|unique:employees,email,'.$employee->id,
            'phone'         => 'nullable|max:20',
        ]);
        $employee->update($validated);
        return redirect()->route('employees.index')->with('success', 'Employee updated.');
    }

    public function destroy(Employee $employee) {
        $employee->delete();
        return response()->json(['success' => 'Employee deleted.']);
    }
}