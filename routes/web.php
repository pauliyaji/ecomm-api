<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//to create the keygen file
//napo just for test
Route::get('/raulgen', function(){
    Artisan::call('key:generate');
    return response()->json("Keygen successful");
});
Route::get('/raulrefresh', function(){
    Artisan::call('migrate:refresh');
    return response()->json('Migration Refreshed');
});
