<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\LogsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

// guest
Route::get('/login', function () {
    return view('pages.guest.login');
})->name('login');
Route::get('/', function () {
    return view('pages.auth.dashbboard');
})->name('dashboard');
Route::get('/getParkingSlots', [DashboardController::class, 'getParkingSlots']);
Route::post('/login-user', [GuestController::class, 'processLogin'])->name('login-user');
Route::get('/logout', [GuestController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/get-waiting-list', function () {
    return Storage::get('waiting/waiting.json');
});

// authenticated routes
Route::post('/input-queue', [DashboardController::class, 'inputQueue'])->name('input-queue')->middleware('auth');
Route::get('/logs', [LogsController::class, 'index'])->name('logs')->middleware('auth');
Route::get('/get-months-for-chart-one/{year}', [DashboardController::class, 'getMonthsForChart'])->middleware('auth');
Route::get('/get-data-per-slot-per-month/{slot}/{year}', [DashboardController::class, 'getDataPerMonthPerSlot'])->middleware('auth');

// Route::get('/create-token', function (Request $request) {
//     $token = $request->user()->createToken('nodemcu');

//     return response()->json([
//         'token' => $token,
//     ]);
// });
