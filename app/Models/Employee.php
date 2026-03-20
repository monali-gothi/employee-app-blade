<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model {
    use SoftDeletes;
    protected $fillable = [
        'full_name', 'employee_code', 'department_id',
        'manager_id', 'joining_date', 'email', 'phone'
    ];
    protected $casts = [
        'joining_date' => 'date',
    ];
    public function department() { return $this->belongsTo(Department::class); }
    public function manager()    { return $this->belongsTo(Manager::class); }
}