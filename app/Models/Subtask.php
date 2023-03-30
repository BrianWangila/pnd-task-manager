<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;


class Subtask extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'dueDate',
        'task_id'
        
    ];

    public function task(){
        return $this->belongsTo(Task::class);

        
    }
}
