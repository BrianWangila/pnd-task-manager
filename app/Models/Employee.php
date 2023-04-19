<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\Project;
use App\Models\Task;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        "department_id", 
        "user_id",
        "job_title", 
        "role", 
        "organization",
        "address",
        "phone",
        "country",
        "about",
        "image_url"
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function tasks (){
        return $this->hasMany(Task::class, "employee_id", "id");
    }

    public function user(){
        return $this->hasOne(User::class, "id", "user_id");
    }
}
