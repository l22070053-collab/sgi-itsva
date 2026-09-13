<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Autenticación (100% externa vía API, sin guards nativos de Eloquent)
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'create'])->name('login');

Route::post('/login', [LoginController::class, 'store'])
    ->middleware('throttle:5,1') // máx. 5 intentos por minuto por IP
    ->name('login.store');

Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

/*
|--------------------------------------------------------------------------
| Ruta protegida (requiere access_token válido en sesión)
|--------------------------------------------------------------------------
*/

Route::middleware('auth.session')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', [
            'username'    => session('username'),
            'id'          => session('id'),
            'permissions' => session('permissions', []),
        ]);
    })->name('dashboard');
});

Route::get('/', fn () => redirect()->route('login'));