<?php

use App\Http\Controllers\Api\CampaignController;
use App\Http\Controllers\Api\CampaignsNoteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CharacterController;
use App\Http\Controllers\Api\MainPageController;

Route::prefix('main-page')->group(function () {
    Route::get('/characters', [MainPageController::class, 'getAllCharacters']);
    Route::get('/campaigns', [MainPageController::class, 'getAllCampaigns']);
});

Route::prefix('character')->group(function () {
    Route::get('{id}', [CharacterController::class, 'getCharacterById']);
});

Route::prefix('campaigns')->group(function () {
    Route::get('{id}', [CampaignController::class, 'getCampaignById']);
});

Route::prefix('campaign-notes')->group(function () {
    Route::post('/', [CampaignsNoteController::class, 'store']);
    Route::put('{id}', [CampaignsNoteController::class, 'update']);
    Route::delete('{id}', [CampaignsNoteController::class, 'destroy']);
});
