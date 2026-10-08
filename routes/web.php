<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\RacController;
use App\Http\Controllers\RamController;
use App\Http\Controllers\SalidaNoConformeController;
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
| Rutas protegidas (requieren access_token válido en sesión)
|--------------------------------------------------------------------------
*/

Route::middleware('auth.session')->group(function () {
    
    // Dashboard principal
    Route::get('/dashboard', function () {
        return view('dashboard', [
            'username'    => session('username'),
            'id'          => session('id'),
            'permissions' => session('permissions', []),
        ]);
    })->name('dashboard');

    // Módulos del Sistema de Gestión Integral (SGI)
    Route::resource('rac', RacController::class);
    Route::resource('ram', RamController::class);
    Route::resource('salida-no-conforme', SalidaNoConformeController::class);
    Route::resource('incidencia', IncidenciaController::class);

});

// Redirección de raíz al login
Route::get('/', fn () => redirect()->route('login'));