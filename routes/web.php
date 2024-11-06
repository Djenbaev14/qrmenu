<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
})->name('home')->middleware('auth');

// register
Route::get('/register', [AuthController::class, 'registerPage'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
// login
Route::get('/login', [AuthController::class, 'loginPage'])->name('loginPage')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');


// logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// resource
Route::resource('settings', SettingController::class)->middleware('auth');
Route::resource('categories', CategoryController::class)->middleware('auth');
Route::resource('products', ProductController::class)->middleware('auth');
Route::post('/products/is_active', [ProductController::class, 'isActive'])->name('isActive')->middleware('auth');


// Route::post('/categories/{}', [AuthController::class, 'login'])->name('login');