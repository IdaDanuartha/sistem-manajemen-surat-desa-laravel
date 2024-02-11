<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\LetterHistoryController;
use App\Http\Controllers\Letters\DieselPurchaseLetterController;
use App\Http\Controllers\Letters\ParentalPermissionLetterController;
use App\Http\Controllers\Letters\SkBirthController;
use App\Http\Controllers\Letters\SkDieController;
use App\Http\Controllers\Letters\SkDomicileController;
use App\Http\Controllers\Letters\SkGrantController;
use App\Http\Controllers\Letters\SkLandPriceController;
use App\Http\Controllers\Letters\SkMaritalStatusController;
use App\Http\Controllers\Letters\SkMarryController;
use App\Http\Controllers\Letters\SkMoveController;
use App\Http\Controllers\Letters\SkNameController;
use App\Http\Controllers\Letters\SkParentIncomeController;
use App\Http\Controllers\Letters\SkResidenceController;
use App\Http\Controllers\Letters\SkSubsidizedHousingController;
use App\Http\Controllers\Letters\SktmController;
use App\Http\Controllers\Letters\SkTravellingController;
use App\Http\Controllers\Letters\SktuController;
use App\Http\Controllers\Letters\TreeFellingLetterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\SkDomicileLetter;
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
    Route::get('users', [UserController::class, 'index'])->middleware('is_admin')->name("users.index");    
    Route::resource('citizents', UserController::class)->except('index')->middleware('is_admin');    
    Route::resource('admins', AdminController::class)->middleware('is_admin');    

    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Route::resource("letters", LetterController::class);
    // Route::get("letter/preview", [LetterController::class, 'download'])->name('letters.preview');
    // Route::get("letters/{letter}/preview", [LetterController::class, 'preview'])->name('letters.preview');
    // Route::put("letters/{letter}/approve", [LetterController::class, 'approveLetter'])->name('letters.approve');
    // Route::put("letters/{letter}/signed", [LetterController::class, 'addSignatureToLetter'])->name('letters.signed');

    // Letters
    Route::resource("letters/sk-birth", SkBirthController::class, ['as' => 'letters']);
    Route::get("letters/sk-birth/{sk_birth}/preview", [SkBirthController::class, 'preview'])->name('letters.sk-birth.preview');
    Route::get("letters/sk-birth/{sk_birth}/download/{type?}", [SkBirthController::class, 'download'])->name('letters.sk-birth.download');
    Route::put("letters/sk-birth/{sk_birth}/approve", [SkBirthController::class, 'approveLetter'])->name('letters.sk-birth.approve');
    Route::put("letters/sk-birth/{sk_birth}/reject", [SkBirthController::class, 'rejectLetter'])->name('letters.sk-birth.reject');

    Route::resource("letters/sk-marry", SkMarryController::class, ['as' => 'letters']);
    Route::resource("letters/sk-marital-status", SkMaritalStatusController::class, ['as' => 'letters']);
    Route::resource("letters/sktu", SktuController::class, ['as' => 'letters']);
    Route::resource("letters/sktm", SktmController::class, ['as' => 'letters']);
    Route::resource("letters/sk-name", SkNameController::class, ['as' => 'letters']);
    Route::resource("letters/sk-subsidized-housing", SkSubsidizedHousingController::class, ['as' => 'letters']);
    Route::resource("letters/sk-move", SkMoveController::class, ['as' => 'letters']);
    Route::resource("letters/sk-travelling", SkTravellingController::class, ['as' => 'letters']);
    Route::resource("letters/sk-residence", SkResidenceController::class, ['as' => 'letters']);
    Route::resource("letters/sk-land-price", SkLandPriceController::class, ['as' => 'letters']);
    Route::resource("letters/sk-parent-income", SkParentIncomeController::class, ['as' => 'letters']);
    // Route::resource("letters/sk-bi", Sk::class, ['as' => 'letters']); // sk silsilah dan kuasa
    Route::resource("letters/sk-die", SkDieController::class, ['as' => 'letters']);
    Route::resource("letters/parental-permission", ParentalPermissionLetterController::class, ['as' => 'letters']);
    Route::resource("letters/sk-grant", SkGrantController::class, ['as' => 'letters']);
    Route::resource("letters/diesel-purchase", DieselPurchaseLetterController::class, ['as' => 'letters']);
    Route::resource("letters/sk-domicile", SkDomicileController::class, ['as' => 'letters']);
    // Route::resource("letters/sk-birth", Sk::class, ['as' => 'letters']); // surat pendaftaran
    Route::resource("letters/tree-felling", TreeFellingLetterController::class, ['as' => 'letters']);

    Route::middleware('is_citizent')->group(function() {
        Route::get("histories", [LetterHistoryController::class, 'index'])->name('histories.index');
        Route::get("histories/{history}", [LetterHistoryController::class, 'show'])->name('histories.show');
    });
});

Route::fallback(function() {
    return view('errors.404');
});