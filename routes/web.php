<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonaturController;
use App\Http\Controllers\FundraiserController;
use App\Http\Controllers\FundraishingPhaseController;
use App\Http\Controllers\FundraishingWidrawalController;
use App\Http\Controllers\FundraisingController;
use App\Http\Controllers\FundraisingPhaseController;
use App\Http\Controllers\FundraisingWithdrawalController;
use App\Http\Controllers\ProfileController;
use App\Models\Fundraiser;
use App\Models\FundraisingWithdrawal;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function(){
        Route::resource('categories', CategoryController::class)->middleware('role:owner');

        Route::resource('donaturs', DonaturController::class)->middleware('role:owner');

        Route::resource('fundraisers', FundraiserController::class)->middleware('role:owner')->except('index');

        Route::get('Fundraisers', [FundraiserController::class, 'index'])->name('fundraisers.index'); 

        Route::resource('fundraishing_widrawals', FundraisingWithdrawalController::class)->middleware('role:owner|fundraiser');

        Route::post('/fundraising_withdrawals/request/{fundraising}', 
        [FundraisingWithdrawalController::class, 'store'])
        ->middleware('role:fundraiser')
        ->name('fundraising_withdrawals.store');

        Route::resource('fundraishing_phases', FundraisingPhaseController::class)->middleware('role:owner|fundraiser');

        Route::post('/fundraising_phases/request/{fundraising}', 
        [FundraisingPhaseController::class, 'store'])
        ->middleware('role:fundraiser')
        ->name('fundraising_phases.store');

        Route::resource('fundraisings', FundraisingController::class)->middleware('role:owner|fundraiser');

        Route::post('/fundraisings/active/{fundraising}', [FundraisingController::class, 'activate_fundraising'])->middleware('role:owner')->name('fundraishing_widrawals.activate_fundraising');

        Route::post('/fundraiser/apply', [DashboardController::class, 'apply_fundraiser'])->name('fundraiser.apply');

        Route::get('/my_withdrawals', [DashboardController::class, 'my_withdrawals'])->name('my_withdrawals');
        Route::get('/my_withdrawals/detail/{fundraisingwithdrawal}', [DashboardController::class, 'my_withdrawals'])->name('my-withdrawals.details');
    });
});

require __DIR__.'/auth.php';
