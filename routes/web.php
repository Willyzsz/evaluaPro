<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CapacitadorController;
use App\Http\Controllers\UsuarioController;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        switch ($user->rol_usuario) {
            case 'admin':
                return redirect('/dashboard');
            case 'capacitador':
                return redirect('/capacitador');
            case 'usuario':
                return redirect('/usuario');
            default:
                return redirect()->route('login');
        }
    }
    return redirect()->route('login');
});


Route::middleware(['auth', 'rol:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index']);
    Route::get('/admin_examenes', [AdminController::class, 'examenes']);
});



Route::middleware(['auth', 'rol:capacitador'])->group(function () {
    Route::get('/capacitador', [CapacitadorController::class, 'index']);
});

Route::middleware(['auth', 'rol:usuario'])->group(function () {
    Route::get('/usuario', [UsuarioController::class, 'index']);
});


require __DIR__.'/auth.php';
