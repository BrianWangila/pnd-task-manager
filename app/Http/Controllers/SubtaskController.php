<?php

namespace App\Http\Controllers;

use App\Models\Subtask;
use App\Models\Task;
use Illuminate\Http\Request;

class SubtaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subtasks = Subtask::orderBy('status', 'ASC')->get();
        return $subtasks;
    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $subtask = Subtask::create([
                "title" => $request -> title,
                "task_id" => $request -> taskId,
                "description" => $request -> description, 
                "dueDate" => date('Y-m-d', strtotime($request->dueDate)),
            ]);

            return ([
                $subtask, 
                "message" => "Milestone added to this task"
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
    public function show( $id)
    {
        $subtask = Subtask::with("task")->find($id);
        
        return $subtask;
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $subtask = Subtask::find($id);

            $subtask->update($request->all());
                
            //     [
            //     "title" => $request -> title,
            //     "status" => $request -> status,
            //     "description" => $request -> description, 
            //     "dueDate" => date('Y-m-d', strtotime($request->dueDate)),
            // ]);

            return ([
                $subtask, 
                "message" => "Milestone updated"
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
    public function destroy($id)
    {
        $subtask = SubTask::find($id);
        $subtask->delete();
        return response()->json(null, 204);
    }
}
