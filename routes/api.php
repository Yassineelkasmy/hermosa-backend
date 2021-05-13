<?php


use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FlutterAppController;

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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/verify', [AuthController::class, 'verify']);
Route::post('/forgot', [AuthController::class, 'forgot']);
Route::post('/reset', [AuthController::class, 'reset']);
Route::post('/resendconfirmation', [AuthController::class, 'resendConfirmationVerifcation']);
Route::post('/resendreset', [AuthController::class, 'resendResetVerifcation']);


Route::group(['middleware' => ['auth:sanctum'],], function ($route) {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);


});


Route::get('/categories', [FlutterAppController::class,'categories']);
Route::get('/colors', [FlutterAppController::class,'colors']);
Route::get('/sizes', [FlutterAppController::class,'sizes']);
Route::get('products/category/{categoryId}', [ProductsController::class,'byCategory']);
