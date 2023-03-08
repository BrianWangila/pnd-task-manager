<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;

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
        "country"
    ];

    public function employees(){
        
        return $this->belongsTo(Department::class);
    }
}
