<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TagController;
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



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::resource('/products', ProductController::class);
    Route::resource('/colors', ColorController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/tags', TagController::class);
});
