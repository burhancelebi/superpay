<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BackofficeController;
use App\Http\Controllers\Admin\Customers\CustomerController;
use App\Http\Controllers\Admin\Settings\SettingController;
use App\Http\Controllers\Admin\Transactions\TransactionController;
use App\Http\Controllers\Admin\Users\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->group(function () {

    Route::get('/', [BackofficeController::class, 'index'])->name('backoffice');
    Route::get('/maintenance/{status}', [BackofficeController::class, 'maintenance'])->name('maintenance');

    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('settings.index');
        Route::match(['get', 'put'], 'logo', [SettingController::class, 'logo'])
            ->name('settings.logo');
        Route::match(['get', 'put'], 'site-title', [SettingController::class, 'siteTitle'])
            ->name('settings.site_title');
    });

    Route::prefix('transactions')->as('transactions.')->group(function () {
        Route::get('/', [TransactionController::class, 'index'])->name('index');
        Route::get('/{id}/edit', [TransactionController::class, 'edit'])->name('edit');
        Route::post('/', [TransactionController::class, 'store'])->name('store');
        Route::get('{id}', [TransactionController::class, 'show'])->name('show');
        Route::put('{id}', [TransactionController::class, 'update'])->name('update');
        Route::delete('{id}', [TransactionController::class, 'destroy'])->name('destroy');
        Route::get('/excel/exports', [TransactionController::class, 'export'])->name('export');
    });

    Route::prefix('customers')->group(function () {
        Route::get('/{customerId}', [CustomerController::class, 'show'])
            ->name('customers.show');
    });

    Route::resource('users', UserController::class);
    Route::prefix('users')->group(function () {
        Route::get('update-status/{userId}', [UserController::class, 'updateStatus'])
            ->name('users.updateStatus');
    });
});

Route::middleware('web')->group(function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('login.form');
        Route::post('login', [AuthController::class, 'login'])->name('login');
    })->middleware(['guest']);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

    Route::get('password/reset', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [AuthController::class, 'reset'])->name('password.update');
});
