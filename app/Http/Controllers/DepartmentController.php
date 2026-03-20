<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index() {
        $departments = Department::latest()->get();
        return view('departments.index', compact('departments'));
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required|unique:departments,name|max:100']);
        Department::create($request->only('name'));
        return back()->with('success', 'Department created successfully.');
    }

    public function update(Request $request, Department $department) {
        $request->validate(['name' => 'required|unique:departments,name,'.$department->id.'|max:100']);
        $department->update($request->only('name'));
        return back()->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department) {
        $department->delete();
        return back()->with('success', 'Department deleted successfully.');
    }
}