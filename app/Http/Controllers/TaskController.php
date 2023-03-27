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
        
        // $user = Employee::with('user')->where()->get();

        // foreach ($tasks as $task){

        //     if(!is_null($task->employee)) {
        //         $task['assignee'] = $user;
        //     }
        // };
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

              

        try {
        $task = Task::create([
                "task_title" => $request -> task_title,
                "project_id" => $request -> project_id, 
                "description" => $request -> description, 
                "deadline" => date('Y-m-d', strtotime($request->deadline)),
                "priority" => $request -> priority ? 1 : 0
            ]);

            return ([
                $task, 
                "message" => "Task added to this project"
            ]);
        } catch (\Throwable $th) {
            $response = [
                "status" => 500,
                "message" => "Something went wrong",
                "error" => $th->getMessage()
            ];

            return response()->json($response, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $user = Employee::where('user_id', 'id')->get();
        $task = Task::with("project", "employee")->find($id);
        $userID = $task->employee->user_id;
        $user = User::where('id',$userID);
        // foreach($user as $item){
        //     $item['user'] = "user";
        // }
        
        return ([
            $task,
            $user
        ]);
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
    public function update(Request $request, $id)
    {
        
        try {
            $task = Task::find($id);

            $task->update([
                "description" => $request -> description, 
                "deadline" => date('Y-m-d', strtotime($request->deadline)),
                "priority" => $request -> priority ? 1 : 0,
                "employee_id" => $request -> employee_id,
                "task_title" => $request -> task_title,
            ]);

            return response([
                $task,
                "message" => "Task has been updated",
            ]);
        } catch (\Throwable $th) {
            $response = [
                "status" => 500,
                "message" => "Something went wrong",
                "error" => $th->getMessage()
            ];

            return response()->json($response, 500);
        }
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
