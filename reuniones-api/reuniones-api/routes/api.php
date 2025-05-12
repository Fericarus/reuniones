<?php

use App\Http\Controllers\ReunionController;

Route::get('/reuniones', [ReunionController::class, 'index']);
Route::apiResource('reuniones', ReunionController::class);