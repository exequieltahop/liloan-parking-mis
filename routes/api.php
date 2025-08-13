<?php

use App\Http\Controllers\SensorDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('/log-data/{slot_no}/{status}', [SensorDataController::class, 'logData']);
Route::post('/get-data', [SensorDataController::class, 'getData']);
