<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CapacitadorController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\OverallController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\GestionUsuarioController;
use App\Http\Controllers\TemaController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\ReporteController;


use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        switch ($user->rol_usuario) {
            case 'admin':
                return redirect('/dashboard');
            case 'capacitador':
                return redirect('/dashboard');
            case 'usuario':
                return redirect('/usuario');
            default:
                return redirect()->route('login');
        }
    }
    return redirect()->route('login');
});


Route::middleware(['auth', 'rol:admin'])->group(function () {
    Route::get('/gestion_usuarios', [GestionUsuarioController::class, 'index']);
    Route::get('/gestion_puestos', [PuestoController::class, 'index']);
});

Route::middleware(['auth', 'rol:admin,capacitador'])->group(function () {
    Route::get('/dashboard', [OverallController::class, 'dashboard']);
    Route::get('/gestion_examenes', [ExamenController::class, 'index']);
    Route::get('/gestion_temas', [TemaController::class, 'index']);
    Route::get('/gestion_reportes', [ReporteController::class, 'index']);
});

Route::middleware(['auth', 'rol:capacitador'])->group(function () {
    Route::get('/capacitador', [CapacitadorController::class, 'index']);
});

Route::middleware(['auth', 'rol:capacitador,usuario'])->group(function () {
    Route::get('/capacitador_usuario', [CapacitadorController::class, 'index']);
});

Route::middleware(['auth', 'rol:usuario'])->group(function () {
    Route::get('/usuario', [UsuarioController::class, 'index']);
});

Route::middleware(['auth', 'rol:admin,capacitador,usuario'])->group(function () {
    Route::get('/welcome', [OverallController::class, 'welcome']);
});

require __DIR__.'/auth.php';
