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

            $user = $request->user();

            if(!$user){
                $response = [
                    "status" => 500,
                    "message" => "Something went wrong"
                ];

                return response()->json($response, 500);
            } else {
                $project = Project::create($request->all());
                return $project;
            }
            
        } catch (\Throwable $e) {
            $response = [
                "status" => 500,
                "message" => "Something went wrong",
                "error" => $e->getMessage()
            ];

            return response()->json($response, 500);
        }
    }

    public function delete($id){
        $project = Project::find($id);
        $project->delete();
        return response()->json(null, 204);
    }

    public function update(Request $request, $id){
        $project = Project::find($id);
        $project->update($request->all());
        return $project;
    }
}
