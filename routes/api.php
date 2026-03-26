<?php

use App\Http\Controllers\SensorDataController;
use Illuminate\Support\Facades\Route;

Route::post('/log-data/{slot_no}/{status}', [SensorDataController::class, 'logData'])->middleware('auth:sanctum');
Route::post('/get-data', [SensorDataController::class, 'getData'])->middleware('auth:sanctum');
