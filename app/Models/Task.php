<?php

namespace App\Models;

use App\Models\Project;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        "project_id",
        "employee_id",
        "task_title", 
        "description", 
        "deadline", 
        "status",
        "reminder"
    ];

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function subtasks(){
        return $this->hasMany(Subtask::class, 'task_id')->orderBy('status', 'ASC');

        
    }
}
