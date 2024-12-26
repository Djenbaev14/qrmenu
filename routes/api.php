<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ClientAuthController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\Api\ProductController;
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


// prefix
Route::prefix('restaurants')->group(function () {
    Route::get('/', [CompanyController::class, 'index']);
    Route::prefix('{restaurant_slug}')->group(function () {
        // Route::apiResource('/',CompanyController::class);
        Route::get('/', [CompanyController::class, 'show']);
        // prefix
        Route::prefix('{category_id}')->group(function () {
            Route::apiResource('/', CategoryController::class);
            Route::prefix('{product_id}')->group(function () {
                Route::apiResource('/',ProductController::class);
            });
        });
    });
});


Route::post('/logout', [ClientAuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/register', [ClientAuthController::class, 'register']);
Route::post('/login', [ClientAuthController::class, 'login']);

Route::apiResource('/orders',OrderController::class)->middleware('auth:sanctum');