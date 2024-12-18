<?php

use App\Http\Controllers\AllCategoriesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OpinionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QrCodeController;
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

   


Route::group(['middleware' => ['auth']], function () {
        Route::resource('clients', ClientController::class);
        // resource
        Route::resource('settings', SettingController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::post('/products/is_active', [ProductController::class, 'isActive'])->name('isActive');
        Route::resource('feedback', OpinionController::class);
        Route::resource('qr-code', QrCodeController::class);
        // routes/web.php
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/news', [OrderController::class, 'news'])->name('orders.news');
        Route::get('/orders/process', [OrderController::class, 'process'])->name('orders.process');
        Route::get('/orders/expired', [OrderController::class, 'expired'])->name('orders.expired');
        Route::get('/orders/ready', [OrderController::class, 'ready'])->name('orders.ready');
        Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history');
});

Route::prefix('admin')
->middleware(['auth'])
->group(function () {
    Route::resource('all-categories', AllCategoriesController::class);
    Route::post('/get-categories', [AllCategoriesController::class, 'getCategories'])->name('get.categories');
    Route::resource('companies', CompanyController::class);
    Route::post('/companies/key/{user}', [CompanyController::class, 'key'])->name('companies.key');
});
