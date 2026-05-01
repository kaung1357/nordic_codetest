<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// Auth
// Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public products (everyone can see)
// Route::get('/products', [ProductController::class, 'index']);
// Route::get('/products/{id}', [ProductController::class, 'show']);


/*
|--------------------------------------------------------------------------
| USER ROUTES (Login Required)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/orders', [OrderController::class, 'store']);

    // Route::post('/products', [ProductController::class, 'store']);
    // Route::put('/products/{id}', [ProductController::class, 'update']);
    // Route::delete('/products/{id}', [ProductController::class, 'destroy']);


    // Cart


    // Orders (user own orders)
    // Route::get('/orders', [OrderController::class, 'index']);
    // Route::get('/orders/{id}', [OrderController::class, 'show']);
    // Route::get('/my-orders', [OrderController::class, 'myOrders']);
    // Route::post('/orders', [OrderController::class, 'store']);
    // Route::patch('/admin/orders/{id}/approve', [OrderController::class, 'approve']);
    // Route::patch('/admin/orders/{id}/reject', [OrderController::class, 'reject']);

    // Checkout
});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (Admin Only)
|--------------------------------------------------------------------------
*/

// Route::middleware(['auth:sanctum'])->group(function () {

//     // Category CRUD

//     // Product CRUD (create, update, delete)
//     // Route::get('/products', [ProductController::class, 'index']);
//     // Route::post('/products', [ProductController::class, 'store']);
//     // Route::put('/products/{id}', [ProductController::class, 'update']);
//     // Route::delete('/products/{id}', [ProductController::class, 'destroy']);

//     Route::get('/admin/orders', [OrderController::class, 'adminIndex']); // Admin က order အားလုံးကြည့်ဖို့
//     Route::patch('/admin/orders/{id}/approve', [OrderController::class, 'approve']);
//     Route::patch('/admin/orders/{id}/reject', [OrderController::class, 'reject']);
// });
