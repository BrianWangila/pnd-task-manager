<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\FileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// public Routes
Route::post("login", [AuthController::class, "login"]);



// protected Routes
Route::group(["middleware" => ["auth:sanctum"]], function(){
    Route::post("logout", [AuthController::class, 'logout']);
    Route::post("register", [AuthController::class, 'register']);

    Route::get("projects", [ProjectController::class, 'index']);
    Route::get('projects/{project}', [ProjectController::class, 'show']);
    Route::post('projects', [ProjectController::class, 'store']);
    Route::delete('projects/{project}', [ProjectController::class, 'delete']);
    Route::post('projects/{project}', [ProjectController::class, 'update']);  //update

    Route::get('employees', [EmployeeController::class, 'index']);
    Route::get('employees/{employee}', [EmployeeController::class, 'show']);
    Route::get('employees/department/{deptID}', [EmployeeController::class, 'employeesByDepartment']);
    Route::post('employees', [EmployeeController::class, 'store']);
    Route::delete('employees/{employee}', [EmployeeController::class, 'delete']);
    Route::post('employees/{employee}', [EmployeeController::class, 'update']);  //update

    Route::get('departments', [DepartmentController::class, 'index']);
    Route::get('departments/{department}', [DepartmentController::class, 'show']);

    Route::get('tasks', [TaskController::class, 'index']);
    Route::get('tasks/{task}', [TaskController::class, 'show']);
    Route::delete('tasks/{task}', [TaskController::class, 'destroy']);
    Route::post('tasks', [TaskController::class, 'store']);

    Route::get('files', [FileController::class, 'index']);
    Route::get('files/{file}', [FileController::class, 'show']);
    Route::post('files', [FileController::class, 'store']);
    Route::post('files/{file}', [FileController::class, 'update']);  //update
    Route::delete('files/{file}', [FileController::class, 'delete']);

    
    
});
