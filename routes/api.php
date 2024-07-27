<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');



Route::middleware('auth:sanctum')->group(function () {
    // Product Routes
    Route::get('/products', [ProductController::class, 'index'])->middleware('permission:read_product');
    Route::post('/products', [ProductController::class, 'store'])->middleware('permission:create_product');
    Route::get('/products/{id}', [ProductController::class, 'show'])->middleware('permission:read_product');
    Route::put('/products/{id}', [ProductController::class, 'update'])->middleware('permission:update_product');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->middleware('permission:delete_product');
    
    // Category Routes
    Route::get('/categories', [CategoryController::class, 'index'])->middleware('permission:read_category');
    Route::post('/categories', [CategoryController::class, 'store'])->middleware('permission:create_category');
    Route::get('/categories/{id}', [CategoryController::class, 'show'])->middleware('permission:read_category');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->middleware('permission:update_category');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->middleware('permission:delete_category');
});