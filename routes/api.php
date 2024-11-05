<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SessionController;
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

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/sessions', [SessionController::class, 'getUserSessions']);
Route::middleware('auth:sanctum')->get('/session/{session_id}', [SessionController::class, 'getSession']);
Route::middleware('auth:sanctum')->get('/locations/{session_id}', [LocationController::class, 'allLocations']);
Route::middleware('auth:sanctum')->get('/location/{id}', [LocationController::class, 'location']);
Route::middleware('auth:sanctum')->get('/items/{session_id}', [ItemController::class, 'allItems']);
Route::middleware('auth:sanctum')->get('/item/{id}', [ItemController::class, 'item']);
