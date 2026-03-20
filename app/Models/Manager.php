<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manager extends Model {
    use SoftDeletes;
    protected $fillable = ['name', 'department_id'];
    public function department() { return $this->belongsTo(Department::class); }
    public function employees()  { return $this->hasMany(Employee::class); }
}