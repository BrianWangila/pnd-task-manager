<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

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
Route::get("projects", [ProjectController::class, 'index']);
Route::get('projects/{project}', [ProjectController::class, 'show']);



// protected Routes
Route::group(["middleware" => ["auth:sanctum"]], function(){
    Route::post("logout", [AuthController::class, 'logout']);
    Route::post('projects', [ProjectController::class, 'store']);
    Route::delete('projects/{project}', [ProjectController::class, 'delete']);
    Route::patch('projects/{project}', [ProjectController::class, 'update']);
    
});