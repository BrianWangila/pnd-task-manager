<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\AuthController;
use App\Models\Employee;
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

        $project = Project::with("department", "tasks")->find($id);
        // $task = Task::where("employee_id", $project->id)->get();


        return $project;
    }

    public function store(Request $request){

        $project_file = $request->file('file');

        // check if img is available;
        if ($project_file) {

            $projectFile    = $project_file;
            $filename         = "project-".time();
            $fileExt          = $projectFile->getClientOriginalExtension();
            $allowedExtensions = ['png', 'jpg', 'jpeg', 'webp', 'pdf', 'docx', 'doc'];
            $destinationPath  = public_path('/assets/img/projects/');

            if (!in_array($fileExt, $allowedExtensions)) return response(['status' => 500, 'message' => "Kindly upload a valid file format"], 500);
            
            $filename = $filename . '.' . $fileExt;
            $projectFile->move($destinationPath, $filename);
        }

        $file_url = "/assets/img/projects/";

        try {

            $project = Project::create([ 
                "project_title" => $request->project_title,
                "department_id" => $request->department_id, 
                "description" => $request->description,
                "file" => $project_file ? $file_url .  $filename : null,
                "deadline" => date('Y-m-d', strtotime($request->deadline)),
                "priority" => $request->priority ? 1 : 0
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

        $project_file = $request->file('file');

        // check if img is available;
        if ($project_file) {

            $projectFile    = $project_file;
            $filename         = "project-".time();
            $fileExt          = $projectFile->getClientOriginalExtension();
            $allowedExtensions = ['png', 'jpg', 'jpeg', 'webp', 'pdf', 'docx', 'doc'];
            $destinationPath  = public_path('/assets/img/projects/');

            if (!in_array($fileExt, $allowedExtensions)) return response(['status' => 500, 'message' => "Kindly upload a valid file format"], 500);
            
            $filename = $filename . '.' . $fileExt;
            $projectFile->move($destinationPath, $filename);
        }

        $file_url = "/assets/img/projects/";

        
        $project = Project::find($id);

        $project->update([
            "project_title" => $request -> project_title,
            "department_id" => $request -> department_id, 
            "description" => $request -> description, 
            "deadline" => $request -> deadline, 
            "priority" => $request -> priority ? 1 : 0,
            "file" => $project_file ? $file_url . $filename : null,
        ]);

        return response([
            "data" => Project::with("department", "tasks")->find($id), 
            "message" => "Project has been updated",
        ]);

    }
}
