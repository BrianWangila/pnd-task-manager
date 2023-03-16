<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\AuthController;
use App\Models\Task;

class ProjectController extends Controller
{
    public function index(){

        $projects = Project::with("department", "tasks")->get();

        // $tasks = Task::with('employee')->get();
        // $projectTasks = [];
    

        // foreach($projects as $project) {
        //     foreach($tasks as $task) {
        //         if($project->id == $task->project_id) {
        //             $projectTasks[] = $task;
        //         }
        //         $project['tasks'] = $projectTasks;
        //     }
        // }
        return $projects;
    }

    public function show($id){
        return Project::with("department", "tasks")->find($id);
    }

    public function store(Request $request){

        try {

            $project = Project::create([ 
                "project_title" => $request->project_title,
                "department_id" => $request->department_id, 
                "description" => $request->description,
                "deadline" => date('Y-m-d', strtotime($request->deadline)),
            ]);
            return response([
               "data" => $project,
               "message" => "Project created."
            ]);
            
        } catch (\Exception $e) {
            $response = [
                "status" => 500,
                "message" => "Something went wrong",
                "error" => $e->getMessage()
            ];

            return response()->json($response, 500);
        }
    }

    public function delete($id){
        
        try {
            $project = Project::find($id);
            $project->delete();

            return response([
                "message" => "Project Deleted"
            ], 204);

        } catch (\Throwable $th) {
            $response = [
                "status" => 500,
                "message" => "Something went wrong",
                "error" => $th->getMessage()
            ];

            return response()->json($response, 500);
        }
    }

    public function update(Request $request, $id){
        $project = Project::find($id);
        $project->update($request->all());
        return $project;
    }
}
