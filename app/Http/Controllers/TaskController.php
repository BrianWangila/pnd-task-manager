<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with("project", "employee", 'subtasks')->orderBy('deadline')->get();

        foreach($tasks as $task){

                $userID = $task->employee->user_id;
                $employee = User::where('id', $userID)->get();

                $task->employee->name = $employee[0]->name;
                $task->employee->email = $employee[0]->email;

                $subTasks = $task->subtasks;
                $completeSubtasks = [];

                foreach($subTasks as $subtask) {

                    if($subtask->status == "complete") {

                        $completeSubtasks[] = $subtask;
                    }
                }

                if($completeSubtasks){
                    $task['progress'] = (count($completeSubtasks) / count($subTasks)) * 100;

                } else {
                    $task['progress'] = 0;
                }

        };
        
        return $tasks;
        
    }


    // Overdue tasks
    public function overdueTasks()
    {
        $tasks = Task::with("employee", "subtasks")->orderBy('deadline')->get();

        $overdueTasks = [];

        foreach($tasks as $task){

            $date = Carbon::now()->format('Y-m-d');

            if($task->deadline <= $date){
                $userID = $task->employee->user_id;
                $employee = User::where('id', $userID)->get();

                $task["name"] = $employee[0]->name;

                $overdueTasks[] = $task;
            }
            
        }

        return $overdueTasks;
    }


    /** 
     * Display tasks depending on deadline
    */
    public function tasksByDate($date){
        $tasks = Task::with('employee', 'subTasks')->get();

        $newTasks = [];

        foreach($tasks as $task){
            $deadline = $task->deadline;
            $userID = $task->employee->user_id;
            $employee = User::where('id', $userID)->get();

            $task->employee->name = $employee[0]->name;
            $task->employee->email = $employee[0]->email;

            if($deadline == $date){
                $newTasks[] = $task;
            };
        };

        return $newTasks;
    }


    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $task = Task::create([
                "task_title" => $request -> task_title,
                "project_id" => $request -> project_id,
                "employee_id" => $request -> employee_id,
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
        
        $task = Task::with("project", "employee", 'subtasks')->find($id);
        $userID = $task->employee->user_id;
        $employee = User::where('id', $userID)->get();
        // $employeeDpt = Department::where('id', $userID)->get();
        
        
        $task->employee['name'] = $employee[0]->name;
        $task->employee['email'] = $employee[0]->email;
        // $task->employee['department'] = $employeeDpt;
        
        
        return $task;
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
                // "priority" => $request -> priority ? 1 : 0,
                "status" => $request -> status,
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
        $task = Task::find($id);
        $task->delete();
        return response()->json(null, 204);
    }
}
