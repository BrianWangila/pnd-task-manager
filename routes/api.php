<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjectController;
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
    Route::get("projects", [ProjectController::class, 'index']);
    Route::get('projects/{project}', [ProjectController::class, 'show']);
    Route::post('projects', [ProjectController::class, 'store']);
    Route::delete('projects/{project}', [ProjectController::class, 'delete']);
    Route::patch('projects/{project}', [ProjectController::class, 'update']);
    Route::get('employees', [EmployeeController::class, 'index']);
    Route::get('employees/{employee}', [EmployeeController::class, 'show']);
    Route::post('employees', [EmployeeController::class, 'store']);
    Route::get('departments', [DepartmentController::class, 'index']);
    Route::get('tasks', [TaskController::class, 'index']);
    Route::get('tasks/{task}', [TaskController::class, 'show']);
    Route::post('tasks', [TaskController::class, 'store']);

    
});