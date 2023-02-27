<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index(){
        return Project::all();
    }

    public function show($id){
        return Project::find($id);
    }

    public function store(Request $request){
        $project = Project::create($request->all());
        return $project;
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
