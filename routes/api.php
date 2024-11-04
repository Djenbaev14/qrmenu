<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CompanyController;
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
Route::prefix('companies/{company_slug}')->group(function () {
    Route::apiResource('/',CompanyController::class);
    // prefix
    Route::prefix('{category_slug}')->group(function () {
        Route::apiResource('/',CategoryController::class);
    });
});

