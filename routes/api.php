<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CharacterController;

Route::prefix('character')->group(function () {
    Route::get('{id}', [CharacterController::class, 'getCharacterById']);
});
