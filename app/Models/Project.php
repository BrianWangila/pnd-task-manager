<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;
use App\Models\Department;
// use dyrynda\Database\Support\CascadeSoftDeletes;


class Project extends Model
{
    // use CascadeSoftDeletes;
    use HasFactory;

    // protected $cascadeDeletes = ['tasks'];

    protected $fillable = [
        "project_title",
        "department_id", 
        "description", 
        "deadline", 
        "status",
        "priority",
        "file",
        
    ];

    public function tasks(){
        return $this->hasMany(Task::class, "project_id", "id");
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    // public function employees(){
    //     return $this->hasMany(Employee::class, "id", "task_id");
    // }
}
