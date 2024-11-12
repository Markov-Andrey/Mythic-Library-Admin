<?php

use App\Http\Controllers\AbilityController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\OrganizationController;
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

Route::middleware('auth:sanctum')->post('/items/{session_id}', [ItemController::class, 'allItems']);
Route::middleware('auth:sanctum')->get('/item/{id}', [ItemController::class, 'item']);
Route::middleware('auth:sanctum')->get('/items/{id}/types', [ItemController::class, 'types']);

Route::middleware('auth:sanctum')->post('/abilities/{session_id}', [AbilityController::class, 'allAbilities']);

Route::middleware('auth:sanctum')->post('/characters/{session_id}', [CharacterController::class, 'allCharacters']);
Route::middleware('auth:sanctum')->get('/character/{id}', [CharacterController::class, 'character']);

Route::middleware('auth:sanctum')->post('/notes/{session_id}', [NoteController::class, 'allNotes']);
Route::middleware('auth:sanctum')->get('/note/{id}', [NoteController::class, 'note']);

Route::middleware('auth:sanctum')->post('/organizations/{session_id}', [OrganizationController::class, 'allOrganizations']);
Route::middleware('auth:sanctum')->get('/organization/{id}', [OrganizationController::class, 'organization']);
