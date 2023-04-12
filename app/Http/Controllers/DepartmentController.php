<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::with("employees", "projects")->get();

        foreach($departments as $department){
            
            $projects = $department->projects;
            $completedProjects = [];

            foreach($department->projects as $project){

                if($project->status == "Completed") {

                    $completedProjects[] = $project;
                };
            };

            if($completedProjects){

                $department['progress'] = (count($completedProjects) / count($projects)) * 100;
                $department['completed_projects'] = $completedProjects;

            } else {

                $department['progress'] = 0;
            };
        };

        return $departments;
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($department)
    {
        $department = Department::with("employees", "projects")->find($department);

        $projects = $department->projects;
            $completedProjects = [];

            foreach($department->projects as $project){

                if($project->status == "Completed") {

                    $completedProjects[] = $project;
                };
            };

            if($completedProjects){
                $department['progress'] = (count($completedProjects) / count($projects)) * 100;
                $department['completed_projects'] = $completedProjects;

            } else {

                $department['progress'] = 0;
            };

        return $department;        
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
    public function destroy(string $id)
    {
        //
    }
}
