<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Employee::all();
        $employees = Employee::with("department", "user", "tasks")->get();
        return $employees;
    }

    public function employeesByDepartment($departmentId) 
    {
        $employees = Employee::with('user')->where('department_id', $departmentId)->get();

        return $employees;
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
        $project = Employee::create($request->all());
        return $project;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Employee::with("department", "user", "tasks")->find($id);
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
