<?php

    use App\Http\Controllers\AppController;
    use App\Http\Controllers\AuthController;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Foundation\Auth\EmailVerificationRequest;

    // home page
    Route::get('/', [AppController::class, 'index'])
        ->name('home');

    // authentification routes 
    Route::prefix('auth')->name('auth.')->group( function () {
        // login routes
        Route::get('login', [AuthController::class, 'showLoginForm'])
            ->name('loginForm');
        Route::post('login', [AuthController::class, 'login'])
            ->name('login');
        // regsiter routes
        Route::get('register', [AuthController::class, 'showRegistrationForm'])
            ->name('regsitrationForm');
        Route::post('register', [AuthController::class, 'register'])
            ->name('register');
        // verify email
        Route::get('verify_email', [AuthController::class, 'verifyEmail'])
            ->name('verifyEmail');
        // confirm email
        Route::get('confirm_email/{hash}', [AuthController::class, 'confirmEmail'])
            ->name('confirmEmail');
    });

