<?php

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

Route::middleware(['throttle:rate_limiter'])->prefix('v1')->group(function () {
  Route::post('register', [\App\Http\Controllers\Api\V1\AuthController::class, 'register']);
  Route::post('login', [\App\Http\Controllers\Api\V1\AuthController::class, 'login']);
});


Route::middleware(['throttle:rate_limiter', 'auth:sanctum'])->prefix('v1')->group(function () {
  Route::post('logout', [\App\Http\Controllers\Api\V1\AuthController::class, 'logout']);
  Route::apiResource('categories', \App\Http\Controllers\Api\V1\CategoryController::class);
  Route::apiResource('posts', \App\Http\Controllers\Api\V1\PostController::class);
});
