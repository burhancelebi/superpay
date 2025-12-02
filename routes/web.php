<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\TaskController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Middleware\UserActiveMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('users')->as('users.')->group(function () {
    Route::middleware(['auth', UserActiveMiddleware::class])->group(function () {
        Route::get('profile', [UserController::class, 'profile'])->name('profile');
        Route::get('payment-methods', [UserController::class, 'paymentMethods'])->name('payment-methods');
        Route::get('transactions', [UserController::class, 'transactions'])->name('transactions');
    });
});

Route::prefix('tasks')->as('tasks.')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('index');
    Route::get('/{id}', [TaskController::class, 'show'])->name('detail');
});

Route::group(['prefix' => 'auth'], function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login-page')
    ->middleware('guest');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login')
    ->middleware('guest');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register-page')
    ->middleware('guest');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register')
    ->middleware('guest');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout')
    ->middleware('auth');

    /**
     * Route::get('/forgot-password', [AuthController::class, 'forgotPasswordPage'])->name('auth.forgot-password-page');
     * Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('auth.forgot-password');
     * Route::get('/reset-password/{token}', [AuthController::class, 'resetPasswordPage'])->name('auth.reset-password-page');
     * Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('auth.reset-password');
     */
});



