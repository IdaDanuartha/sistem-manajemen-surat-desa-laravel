<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard.analytics.index');
})->name('dashboard');

Route::get('dashboard/profile', function() {
    return true;
})->name('profile.index');

Route::get('auth/logout', function() {
    return true;
})->name('logout');