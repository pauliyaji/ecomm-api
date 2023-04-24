<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('view-category', [CategoryController::class, 'index']);
Route::post('store-category', [CategoryController::class, 'store']);
Route::get('edit-category', [CategoryController::class, 'edit']);
Route::post('update-category/{id}', [CategoryController::class, 'update']);
Route::delete('delete-category/{id}', [CategoryController::class, 'destroy']);
Route::get('all-category', [CategoryController::class, 'allcategory']);

//PRODUCTS APIs
Route::post('store-product', [ProductController::class, 'store']);
Route::get('view-product', [ProductController::class, 'index']);
Route::delete('delete-product/{id}', [ProductController::class, 'destroy']);
Route::get('edit-product/{id}', [ProductController::class, 'edit']);
Route::post('update-product/{id}', [ProductController::class, 'update']);
