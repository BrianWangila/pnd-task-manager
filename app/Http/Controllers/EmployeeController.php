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
        try {

            $employees = Employee::with("department", "user", "tasks")->get();

            foreach ($employees as $employee){

                if(!is_null($employee->user)) {
                    $employee['user_name'] = $employee->user->name;
                    $employee['user_email'] = $employee->user->email;
                }
            };

            return $employees;

        } catch (\Throwable $th) {
            $response = [

                "error" => $th->getMessage(),
                "message" => "Something went wrong",

            ];
            return response()->json($response, 500);
        }
    }

    public function employeesByDepartment($departmentId) 
    {
        $employees = Employee::with('user')->where('department_id', $departmentId)->get();

        return $employees;
    }




    /**
     * Store a newly created resource in storage.
     */
    public function update(Request $request, $id)
    {

        $image_file = $request->file('image_file');

        // check if img is available;
        if ($image_file) {

            $imgFile    = $image_file;
            $filename         = "profile-".time();
            $fileExt          = $imgFile->getClientOriginalExtension();
            $allowedExtensions = ['png', 'jpg', 'jpeg', 'webp'];
            $destinationPath  = public_path('/assets/img/profile/');

            if (!in_array($fileExt, $allowedExtensions)) return response(['status' => 500, 'message' => "Sorry, only 'png', 'jpg', 'jpeg', 'webp' files are allowed "], 500);
            
            $filename = $filename . '.' . $fileExt;
            $imgFile->move($destinationPath, $filename);
        }

        $image_url = "/assets/img/profile/";

        $employee = Employee::find($id);

        $employee->update([
            "address" => $request->address,
            "phone" => $request->phone,
            "about" => $request->about,
            "image_url" =>  $image_file ? $image_url . $filename : null,
        ]);

        return response([
            Employee::with('user')->find($id), 
            "message" => "Employee has been updated",
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Employee::with("department", "user", "tasks")->find($id);
    }

  

    /**
     * Update the specified resource in storage.
     */
    // public function store (Request $request)
    // {
    //     $employees = Employee::with("department", "user", "tasks")->get();

    //     foreach ($employees as $employee){

    //         if(!is_null($employee->user)) {
    //             $employee['userId'] = $employee->user->id;
                
    //         }
    //     };

    //     try {
    //         $employee1 = Employee::create([
    //             "department_id" => $request->departmentId, 
    //             "user_id" => $request->userId,
    //             "job_title" => $request -> jobTitle, 
    //             "role" => $request -> role, 
    //         ]);

    //         return response([
    //             $employee1,
    //             "message" => "Employee profile created"
    //         ]);
            
    //     } catch (\exception $e) {
    //         $response = [

    //             "error" => $e->getMessage(),
    //             "message" => "Check your input fields, something went wrong",

    //         ];

    //         return response()->json($response, 500);
    //     }
    
    // }



    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        try {
            $employee = Employee::find($id);
            $employee->delete();

            return response([
                "message" => "Employee Removed"
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
}
