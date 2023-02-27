<?php

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

// api/v1
//Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1', 'middleware' => 'auth:sanctum'], function () {
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function () {
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('invoices', InvoiceController::class);

    Route::post('invoices/bulk', [\App\Http\Controllers\Api\V1\InvoiceController::class, 'bulkStore']);
    Route::post('register', [\App\Http\Controllers\Api\V1\Auth\RegisterController::class, 'register']);
    Route::post('login', [\App\Http\Controllers\Api\V1\Auth\LoginController::class, 'login']);
});

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1', 'middleware' => 'auth:sanctum'], function () {
    Route::get('user', [\App\Http\Controllers\Api\V1\Auth\AuthController::class, 'user']);

    Route::post('logout', [\App\Http\Controllers\Api\V1\Auth\LogoutController::class, 'logout']);
});
