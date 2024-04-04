<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\CitizentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnvironmentalController;
use App\Http\Controllers\EnvironmentalHeadController;
use App\Http\Controllers\LetterHistoryController;
use App\Http\Controllers\Letters\DieselPurchaseLetterController;
use App\Http\Controllers\Letters\InheritanceGeneologyLetterController;
use App\Http\Controllers\Letters\ParentalPermissionLetterController;
use App\Http\Controllers\Letters\RegisterFormLetterController;
use App\Http\Controllers\Letters\SkBirthController;
use App\Http\Controllers\Letters\SkDieController;
use App\Http\Controllers\Letters\SkDomicileController;
use App\Http\Controllers\Letters\SkGrantController;
use App\Http\Controllers\Letters\SkHeirController;
use App\Http\Controllers\Letters\SkInheritanceDistributionController;
use App\Http\Controllers\Letters\SkLandPriceController;
use App\Http\Controllers\Letters\SkMaritalStatusController;
use App\Http\Controllers\Letters\SkMarryController;
use App\Http\Controllers\Letters\SkMoveController;
use App\Http\Controllers\Letters\SkNameController;
use App\Http\Controllers\Letters\SkParentIncomeController;
use App\Http\Controllers\Letters\SkPowerAttorneyController;
use App\Http\Controllers\Letters\SkResidenceController;
use App\Http\Controllers\Letters\SkSubsidizedHousingController;
use App\Http\Controllers\Letters\SktmController;
use App\Http\Controllers\Letters\SkTravellingController;
use App\Http\Controllers\Letters\SktuController;
use App\Http\Controllers\Letters\TreeFellingLetterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionHeadController;
use App\Http\Controllers\SubdistrictHeadController;
use App\Http\Controllers\VillageHeadController;
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
    
    Route::middleware('is_admin')->group(function() {
        Route::resource('citizents', CitizentController::class);
        Route::get('citizents/{citizent}/json', [CitizentController::class, 'showJSON']);

        Route::resource('environmental-heads', EnvironmentalHeadController::class);
        Route::resource('village-heads', VillageHeadController::class);
        Route::resource('section-heads', SectionHeadController::class);
        Route::resource('subdistrict-heads', SubdistrictHeadController::class);

        Route::resource('admins', AdminController::class);   
        Route::resource('environmentals', EnvironmentalController::class);   
    });


    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Letters
    Route::resource("letters/sk-birth", SkBirthController::class, ['as' => 'letters']);
    Route::get("letters/sk-birth/{sk_birth}/preview", [SkBirthController::class, 'preview'])->name('letters.sk-birth.preview');
    Route::get("letters/sk-birth/{sk_birth}/download/{type?}", [SkBirthController::class, 'download'])->name('letters.sk-birth.download');
    Route::put("letters/sk-birth/{sk_birth}/approve", [SkBirthController::class, 'approveLetter'])->name('letters.sk-birth.approve');
    Route::put("letters/sk-birth/{sk_birth}/reject", [SkBirthController::class, 'rejectLetter'])->name('letters.sk-birth.reject');

    Route::resource("letters/sk-marry", SkMarryController::class, ['as' => 'letters']);
    Route::get("letters/sk-marry/{sk_marry}/preview", [SkMarryController::class, 'preview'])->name('letters.sk-marry.preview');
    Route::get("letters/sk-marry/{sk_marry}/download/{type?}", [SkMarryController::class, 'download'])->name('letters.sk-marry.download');
    Route::put("letters/sk-marry/{sk_marry}/approve", [SkMarryController::class, 'approveLetter'])->name('letters.sk-marry.approve');
    Route::put("letters/sk-marry/{sk_marry}/reject", [SkMarryController::class, 'rejectLetter'])->name('letters.sk-marry.reject');

    Route::resource("letters/sk-marital-status", SkMaritalStatusController::class, ['as' => 'letters']);
    Route::get("letters/sk-marital-status/{sk_marital_status}/preview", [SkMaritalStatusController::class, 'preview'])->name('letters.sk-marital-status.preview');
    Route::get("letters/sk-marital-status/{sk_marital_status}/download/{type?}", [SkMaritalStatusController::class, 'download'])->name('letters.sk-marital-status.download');
    Route::put("letters/sk-marital-status/{sk_marital_status}/approve", [SkMaritalStatusController::class, 'approveLetter'])->name('letters.sk-marital-status.approve');
    Route::put("letters/sk-marital-status/{sk_marital_status}/reject", [SkMaritalStatusController::class, 'rejectLetter'])->name('letters.sk-marital-status.reject');

    Route::resource("letters/sktu", SktuController::class, ['as' => 'letters']);
    Route::get("letters/sktu/{sktu}/preview", [SktuController::class, 'preview'])->name('letters.sktu.preview');
    Route::get("letters/sktu/{sktu}/download/{type?}", [SktuController::class, 'download'])->name('letters.sktu.download');
    Route::put("letters/sktu/{sktu}/approve", [SktuController::class, 'approveLetter'])->name('letters.sktu.approve');
    Route::put("letters/sktu/{sktu}/reject", [SktuController::class, 'rejectLetter'])->name('letters.sktu.reject');

    Route::resource("letters/sktm", SktmController::class, ['as' => 'letters']);
    Route::get("letters/sktm/{sktm}/preview", [SktmController::class, 'preview'])->name('letters.sktm.preview');
    Route::get("letters/sktm/{sktm}/download/{type?}", [SktmController::class, 'download'])->name('letters.sktm.download');
    Route::put("letters/sktm/{sktm}/approve", [SktmController::class, 'approveLetter'])->name('letters.sktm.approve');
    Route::put("letters/sktm/{sktm}/reject", [SktmController::class, 'rejectLetter'])->name('letters.sktm.reject');

    Route::resource("letters/sk-name", SkNameController::class, ['as' => 'letters']);
    Route::get("letters/sk-name/{sk_name}/preview", [SkNameController::class, 'preview'])->name('letters.sk-name.preview');
    Route::get("letters/sk-name/{sk_name}/download/{type?}", [SkNameController::class, 'download'])->name('letters.sk-name.download');
    Route::put("letters/sk-name/{sk_name}/approve", [SkNameController::class, 'approveLetter'])->name('letters.sk-name.approve');
    Route::put("letters/sk-name/{sk_name}/reject", [SkNameController::class, 'rejectLetter'])->name('letters.sk-name.reject');

    Route::resource("letters/sk-subsidized-housing", SkSubsidizedHousingController::class, ['as' => 'letters']);
    Route::get("letters/sk-subsidized-housing/{sk_subsidized_housing}/preview", [SkSubsidizedHousingController::class, 'preview'])->name('letters.sk-subsidized-housing.preview');
    Route::get("letters/sk-subsidized-housing/{sk_subsidized_housing}/download/{type?}", [SkSubsidizedHousingController::class, 'download'])->name('letters.sk-subsidized-housing.download');
    Route::put("letters/sk-subsidized-housing/{sk_subsidized_housing}/approve", [SkSubsidizedHousingController::class, 'approveLetter'])->name('letters.sk-subsidized-housing.approve');
    Route::put("letters/sk-subsidized-housing/{sk_subsidized_housing}/reject", [SkSubsidizedHousingController::class, 'rejectLetter'])->name('letters.sk-subsidized-housing.reject');

    Route::resource("letters/sk-move", SkMoveController::class, ['as' => 'letters']);
    Route::get("letters/sk-move/{sk_move}/preview", [SkMoveController::class, 'preview'])->name('letters.sk-move.preview');
    Route::get("letters/sk-move/{sk_move}/download/{type?}", [SkMoveController::class, 'download'])->name('letters.sk-move.download');
    Route::put("letters/sk-move/{sk_move}/approve", [SkMoveController::class, 'approveLetter'])->name('letters.sk-move.approve');
    Route::put("letters/sk-move/{sk_move}/reject", [SkMoveController::class, 'rejectLetter'])->name('letters.sk-move.reject');

    Route::resource("letters/sk-travelling", SkTravellingController::class, ['as' => 'letters']);
    Route::get("letters/sk-travelling/{sk_travelling}/preview", [SkTravellingController::class, 'preview'])->name('letters.sk-travelling.preview');
    Route::get("letters/sk-travelling/{sk_travelling}/download/{type?}", [SkTravellingController::class, 'download'])->name('letters.sk-travelling.download');
    Route::put("letters/sk-travelling/{sk_travelling}/approve", [SkTravellingController::class, 'approveLetter'])->name('letters.sk-travelling.approve');
    Route::put("letters/sk-travelling/{sk_travelling}/reject", [SkTravellingController::class, 'rejectLetter'])->name('letters.sk-travelling.reject');

    Route::resource("letters/sk-residence", SkResidenceController::class, ['as' => 'letters']);
    Route::get("letters/sk-residence/{sk_residence}/preview", [SkResidenceController::class, 'preview'])->name('letters.sk-residence.preview');
    Route::get("letters/sk-residence/{sk_residence}/download/{type?}", [SkResidenceController::class, 'download'])->name('letters.sk-residence.download');
    Route::put("letters/sk-residence/{sk_residence}/approve", [SkResidenceController::class, 'approveLetter'])->name('letters.sk-residence.approve');
    Route::put("letters/sk-residence/{sk_residence}/reject", [SkResidenceController::class, 'rejectLetter'])->name('letters.sk-residence.reject');

    Route::resource("letters/sk-land-price", SkLandPriceController::class, ['as' => 'letters']);
    Route::get("letters/sk-land-price/{sk_land_price}/preview", [SkLandPriceController::class, 'preview'])->name('letters.sk-land-price.preview');
    Route::get("letters/sk-land-price/{sk_land_price}/download/{type?}", [SkLandPriceController::class, 'download'])->name('letters.sk-land-price.download');
    Route::put("letters/sk-land-price/{sk_land_price}/approve", [SkLandPriceController::class, 'approveLetter'])->name('letters.sk-land-price.approve');
    Route::put("letters/sk-land-price/{sk_land_price}/reject", [SkLandPriceController::class, 'rejectLetter'])->name('letters.sk-land-price.reject');

    Route::resource("letters/sk-parent-income", SkParentIncomeController::class, ['as' => 'letters']);
    Route::get("letters/sk-parent-income/{sk_parent_income}/preview", [SkParentIncomeController::class, 'preview'])->name('letters.sk-parent-income.preview');
    Route::get("letters/sk-parent-income/{sk_parent_income}/download/{type?}", [SkParentIncomeController::class, 'download'])->name('letters.sk-parent-income.download');
    Route::put("letters/sk-parent-income/{sk_parent_income}/approve", [SkParentIncomeController::class, 'approveLetter'])->name('letters.sk-parent-income.approve');
    Route::put("letters/sk-parent-income/{sk_parent_income}/reject", [SkParentIncomeController::class, 'rejectLetter'])->name('letters.sk-parent-income.reject');

    Route::resource("letters/inheritance-geneology", InheritanceGeneologyLetterController::class, ['as' => 'letters']);
    Route::get("letters/inheritance-geneology/{inheritance_geneology}/preview", [InheritanceGeneologyLetterController::class, 'preview'])->name('letters.inheritance-geneology.preview');
    Route::get("letters/inheritance-geneology/{inheritance_geneology}/download/{type?}", [InheritanceGeneologyLetterController::class, 'download'])->name('letters.inheritance-geneology.download');
    Route::put("letters/inheritance-geneology/{inheritance_geneology}/approve", [InheritanceGeneologyLetterController::class, 'approveLetter'])->name('letters.inheritance-geneology.approve');
    Route::put("letters/inheritance-geneology/{inheritance_geneology}/reject", [InheritanceGeneologyLetterController::class, 'rejectLetter'])->name('letters.inheritance-geneology.reject');

    Route::resource("letters/sk-heir", SkHeirController::class, ['as' => 'letters']);
    Route::get("letters/sk-heir/{sk_heir}/preview", [SkHeirController::class, 'preview'])->name('letters.sk-heir.preview');
    Route::get("letters/sk-heir/{sk_heir}/download/{type?}", [SkHeirController::class, 'download'])->name('letters.sk-heir.download');
    Route::put("letters/sk-heir/{sk_heir}/approve", [SkHeirController::class, 'approveLetter'])->name('letters.sk-heir.approve');
    Route::put("letters/sk-heir/{sk_heir}/reject", [SkHeirController::class, 'rejectLetter'])->name('letters.sk-heir.reject');

    Route::resource("letters/sk-power-attorney", SkPowerAttorneyController::class, ['as' => 'letters']);
    Route::get("letters/sk-power-attorney/{sk_power_attorney}/preview", [SkPowerAttorneyController::class, 'preview'])->name('letters.sk-power-attorney.preview');
    Route::get("letters/sk-power-attorney/{sk_power_attorney}/download/{type?}", [SkPowerAttorneyController::class, 'download'])->name('letters.sk-power-attorney.download');
    Route::put("letters/sk-power-attorney/{sk_power_attorney}/approve", [SkPowerAttorneyController::class, 'approveLetter'])->name('letters.sk-power-attorney.approve');
    Route::put("letters/sk-power-attorney/{sk_power_attorney}/reject", [SkPowerAttorneyController::class, 'rejectLetter'])->name('letters.sk-power-attorney.reject');

    Route::resource("letters/sk-inheritance-distribution", SkInheritanceDistributionController::class, ['as' => 'letters']);
    Route::get("letters/sk-inheritance-distribution/{sk_inheritance_distribution}/preview", [SkInheritanceDistributionController::class, 'preview'])->name('letters.sk-inheritance-distribution.preview');
    Route::get("letters/sk-inheritance-distribution/{sk_inheritance_distribution}/download/{type?}", [SkInheritanceDistributionController::class, 'download'])->name('letters.sk-inheritance-distribution.download');
    Route::put("letters/sk-inheritance-distribution/{sk_inheritance_distribution}/approve", [SkInheritanceDistributionController::class, 'approveLetter'])->name('letters.sk-inheritance-distribution.approve');
    Route::put("letters/sk-inheritance-distribution/{sk_inheritance_distribution}/reject", [SkInheritanceDistributionController::class, 'rejectLetter'])->name('letters.sk-inheritance-distribution.reject');
    
    Route::resource("letters/sk-die", SkDieController::class, ['as' => 'letters']);
    Route::get("letters/sk-die/{sk_die}/preview", [SkDieController::class, 'preview'])->name('letters.sk-die.preview');
    Route::get("letters/sk-die/{sk_die}/download/{type?}", [SkDieController::class, 'download'])->name('letters.sk-die.download');
    Route::put("letters/sk-die/{sk_die}/approve", [SkDieController::class, 'approveLetter'])->name('letters.sk-die.approve');
    Route::put("letters/sk-die/{sk_die}/reject", [SkDieController::class, 'rejectLetter'])->name('letters.sk-marital-status.reject');

    Route::resource("letters/parental-permission", ParentalPermissionLetterController::class, ['as' => 'letters']);
    Route::get("letters/parental-permission/{parental_permission}/preview", [ParentalPermissionLetterController::class, 'preview'])->name('letters.parental-permission.preview');
    Route::get("letters/parental-permission/{parental_permission}/download/{type?}", [ParentalPermissionLetterController::class, 'download'])->name('letters.parental-permission.download');
    Route::put("letters/parental-permission/{parental_permission}/approve", [ParentalPermissionLetterController::class, 'approveLetter'])->name('letters.parental-permission.approve');
    Route::put("letters/parental-permission/{parental_permission}/reject", [ParentalPermissionLetterController::class, 'rejectLetter'])->name('letters.parental-permission.reject');

    Route::resource("letters/sk-grant", SkGrantController::class, ['as' => 'letters']);
    Route::get("letters/sk-grant/{sk_grant}/preview", [SkGrantController::class, 'preview'])->name('letters.sk-grant.preview');
    Route::get("letters/sk-grant/{sk_grant}/download/{type?}", [SkGrantController::class, 'download'])->name('letters.sk-grant.download');
    Route::put("letters/sk-grant/{sk_grant}/approve", [SkGrantController::class, 'approveLetter'])->name('letters.sk-grant.approve');
    Route::put("letters/sk-grant/{sk_grant}/reject", [SkGrantController::class, 'rejectLetter'])->name('letters.sk-grant.reject');

    Route::resource("letters/diesel-purchase", DieselPurchaseLetterController::class, ['as' => 'letters']);
    Route::get("letters/diesel-purchase/{diesel_purchase}/preview", [DieselPurchaseLetterController::class, 'preview'])->name('letters.diesel-purchase.preview');
    Route::get("letters/diesel-purchase/{diesel_purchase}/download/{type?}", [DieselPurchaseLetterController::class, 'download'])->name('letters.diesel-purchase.download');
    Route::put("letters/diesel-purchase/{diesel_purchase}/approve", [DieselPurchaseLetterController::class, 'approveLetter'])->name('letters.diesel-purchase.approve');
    Route::put("letters/diesel-purchase/{diesel_purchase}/reject", [DieselPurchaseLetterController::class, 'rejectLetter'])->name('letters.diesel-purchase.reject');

    Route::resource("letters/sk-domicile", SkDomicileController::class, ['as' => 'letters']);
    Route::get("letters/sk-domicile/{sk_domicile}/preview", [SkDomicileController::class, 'preview'])->name('letters.sk-domicile.preview');
    Route::get("letters/sk-domicile/{sk_domicile}/download/{type?}", [SkDomicileController::class, 'download'])->name('letters.sk-domicile.download');
    Route::put("letters/sk-domicile/{sk_domicile}/approve", [SkDomicileController::class, 'approveLetter'])->name('letters.sk-domicile.approve');
    Route::put("letters/sk-domicile/{sk_domicile}/reject", [SkDomicileController::class, 'rejectLetter'])->name('letters.sk-domicile.reject');

    Route::resource("letters/registration-form", RegisterFormLetterController::class, ['as' => 'letters']); // surat pendaftaran
    Route::get("letters/registration-form/{registration_form}/preview", [RegisterFormLetterController::class, 'preview'])->name('letters.registration-form.preview');
    Route::get("letters/registration-form/{registration_form}/download/{type?}", [RegisterFormLetterController::class, 'download'])->name('letters.registration-form.download');
    Route::put("letters/registration-form/{registration_form}/approve", [RegisterFormLetterController::class, 'approveLetter'])->name('letters.registration-form.approve');
    Route::put("letters/registration-form/{registration_form}/reject", [RegisterFormLetterController::class, 'rejectLetter'])->name('letters.registration-form.reject');

    Route::resource("letters/tree-felling", TreeFellingLetterController::class, ['as' => 'letters']);
    Route::get("letters/tree-felling/{tree_felling}/preview", [TreeFellingLetterController::class, 'preview'])->name('letters.tree-felling.preview');
    Route::get("letters/tree-felling/{tree_felling}/download/{type?}", [TreeFellingLetterController::class, 'download'])->name('letters.tree-felling.download');
    Route::put("letters/tree-felling/{tree_felling}/approve", [TreeFellingLetterController::class, 'approveLetter'])->name('letters.tree-felling.approve');
    Route::put("letters/tree-felling/{tree_felling}/reject", [TreeFellingLetterController::class, 'rejectLetter'])->name('letters.tree-felling.reject');

    Route::get("histories", [LetterHistoryController::class, 'index'])->name('histories.index');
    Route::get("histories/{sk}", [LetterHistoryController::class, 'show'])->name('histories.show');
});

Route::fallback(function() {
    return view('errors.404');
});