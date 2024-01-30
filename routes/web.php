<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

Route::redirect('/', '/dashboard');

Route::prefix('auth')->group(function() {
    Route::middleware('guest')->group(function() {
        Route::get('login', [LoginController::class, 'login'])->name('login');        
        Route::post('login', [LoginController::class, 'authenticate'])->name('authenticate');        
    });

    Route::middleware('auth')->group(function() {
        Route::post('logout', LogoutController  ::class)->name('logout');
    });

});

Route::middleware(['auth'])->group(function() {
    Route::get('dashboard', DashboardController::class)->name("dashboard");        
    Route::resource('users', UserController::class);    
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

Route::fallback(function() {
    return view('errors.404');
});