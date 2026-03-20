<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DepartmentController, ManagerController, EmployeeController};
use App\Models\{Department, Manager, Employee};

Route::get('/', fn() => redirect()->route('dashboard'));

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard', [
            'departmentCount' => Department::count(),
            'managerCount'    => Manager::count(),
            'employeeCount'   => Employee::count(),
        ]);
    })->name('dashboard');

    Route::resource('departments', DepartmentController::class)
         ->except(['show', 'create', 'edit']);

    Route::resource('managers', ManagerController::class)
         ->except(['show', 'create', 'edit']);

    Route::resource('employees', EmployeeController::class);
    Route::get('/employees-datatable', [EmployeeController::class, 'datatable'])
         ->name('employees.datatable');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
