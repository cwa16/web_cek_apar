<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/get-apar', [ApiController::class, 'getApar']);
Route::post('/save-checklist', [ApiController::class, 'saveChecklist']);
Route::post('/save-checklist-rumah', [ApiController::class, 'saveChecklistRumah']);
