<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\LetterHistoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Barryvdh\DomPDF\Facade\Pdf;
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
        
        Route::controller(ForgotPasswordController::class)->group(function () {
            Route::get('forgot-password', 'forgotPassword')->name('forgot-password');
            Route::post('forgot-password', 'forgotPasswordForm')->name('forgot-password.post');
            Route::get('reset-password/{token}', 'resetPassword')->name('reset-password');
            Route::post('reset-password', 'resetPasswordForm')->name('reset-password.post');
        });
    });

    Route::middleware('auth')->group(function() {
        Route::post('logout', LogoutController  ::class)->name('logout');
    });

});

Route::middleware(['auth'])->group(function() {
    Route::get('dashboard', DashboardController::class)->name("dashboard");        
    Route::resource('users', UserController::class)->middleware('is_admin');    

    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::resource("letters", LetterController::class);
    // Route::get("letter/preview", [LetterController::class, 'download'])->name('letters.preview');
    Route::get("letters/{letter}/preview", [LetterController::class, 'preview'])->name('letters.preview');
    Route::put("letters/{letter}/approve", [LetterController::class, 'approveLetter'])->name('letters.approve');
    Route::put("letters/{letter}/signed", [LetterController::class, 'addSignatureToLetter'])->name('letters.signed');

    Route::middleware('is_citizent')->group(function() {
        Route::get("histories", [LetterHistoryController::class, 'index'])->name('histories.index');
        Route::get("histories/{history}", [LetterHistoryController::class, 'show'])->name('histories.show');
    });
});

Route::fallback(function() {
    return view('errors.404');
});

// Route::get("/tes", function() {
//     $generated = Pdf::loadView('dashboard.letters.letter-template');

//     return $generated->stream("tes.pdf");
// });