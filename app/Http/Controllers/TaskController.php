<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with("project", "employee")->get();
        $user = Employee::with('user')->get();

        foreach ($tasks as $task){

            if(!is_null($task->employee)) {
                $task['assignee'] = $user;
            }
        };

        return $tasks;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'employee_id' => 'nullable|integer',
        // ]);

        $task = Task::create($request->all());
        return $task;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Task::with("project", "employee")->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id){
        $project = Task::find($id);
        $project->delete();
        return response()->json(null, 204);
    }
}
