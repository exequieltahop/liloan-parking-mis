<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\LogsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

// guest
Route::get('/login', function () {
    return view('pages.guest.login');
})->name('login');

// auth
Route::get('/', function () {
    return view('pages.auth.dashbboard');
})->name('dashboard');

Route::get('/getParkingSlots', [DashboardController::class, 'getParkingSlots']);
Route::post('/login-user', [GuestController::class, 'processLogin'])->name('login-user');
Route::get('/logout', [GuestController::class, 'logout'])->name('logout');

// initWaitingList
Route::get('/init-waiting-list', function(){
    Storage::disk('local')->put('waiting/waiting.json', json_encode([
        'waiting' => 23
    ]));
    return response('success', 200);
});

Route::get('/get-waiting-list', function(){
    return Storage::get('waiting/waiting.json');
});

Route::post('/input-queue', [DashboardController::class, 'inputQueue'])->name('input-queue');

Route::get('/logs', [LogsController::class, 'index'])->name('logs')->middleware('authChecker');

Route::get('/logout', function(Request $request){
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->name('logout');

Route::get('/get-months-for-chart-one/{year}', [DashboardController::class, 'getMonthsForChart']);