<?php

use App\Http\Controllers\Guest\GuestController;
use Illuminate\Support\Facades\Route;


// guest
Route::get('/', function () {
    return view('pages.guest.login');
})->name('login');

// auth
Route::get('/dashboard', function () {
    return view('pages.auth.dashbboard');
})->name('dashboard')->middleware('authChecker');

Route::post('/login-user', [GuestController::class, 'processLogin'])->name('login-user');
