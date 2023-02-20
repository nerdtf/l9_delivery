<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Client\ClientController;
use App\Http\Controllers\Api\Client\LoginController;
use App\Http\Controllers\Api\CourierController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
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

Route::post('login', [AuthController::class, 'login']);
Route::prefix('client')->group(function () {
    Route::post('register', [ClientController::class, 'store']);
    Route::post('update', [ClientController::class, 'update']);
    Route::post('login', [LoginController::class, 'login']);
});
Route::apiResources([
    'users'    =>  UserController::class,
    'products' =>  ProductController::class,
    "couriers" =>  CourierController::class
]);
Route::middleware('auth:client')->group(function () {
    Route::apiResource('orders', OrderController::class)->only("index", "store", "destroy", "show");
});
