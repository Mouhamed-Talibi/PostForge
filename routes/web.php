<?php

    use App\Http\Controllers\AppController;
    use App\Http\Controllers\AuthController;
    use Illuminate\Support\Facades\Route;

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
        Route::post('login', [AuthController::class, 'register'])
            ->name('regsiter');
    });
