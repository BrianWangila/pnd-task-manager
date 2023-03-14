<?php

use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Artisan::call('migrate');

Route::get('/{any}', function () {
    return view('spa');
})->where('any', '.*');

