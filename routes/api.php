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

Route::apiResource('locations', \App\Http\Controllers\Api\locationsController::class)->only(['index', 'store']);
Route::apiResource('sensors', \App\Http\Controllers\Api\sensorsController::class)->only(['index', 'store']);
Route::apiResource('visitors', \App\Http\Controllers\Api\visitorsController::class)->only(['index', 'store']);
Route::get('/summary', [\App\Http\Controllers\Api\summaryController::class, 'index']);

