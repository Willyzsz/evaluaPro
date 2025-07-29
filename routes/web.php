<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CapacitadorController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\OverallController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\GestionUsuarioController;
use App\Http\Controllers\TemaController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\PreguntaController;


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
    Route::resource('usuarios', GestionUsuarioController::class)->parameters([
        'usuarios' => 'usuario'
        ])->names([
            'index' => 'usuarios.index',
            'create' => 'usuarios.create',
            'store' => 'usuarios.store',
            'show' => 'usuarios.show',
            'edit' => 'usuarios.edit',
            'update' => 'usuarios.update',
            'destroy' => 'usuarios.destroy',
        ]);
    Route::get('/gestion_usuarios', [GestionUsuarioController::class, 'index'])->name('gestion_usuarios');
    Route::resource('puestos', PuestoController::class)->parameters([
        'puestos' => 'puesto'
        ])->names([
            'index' => 'puestos.index',
            'create' => 'puestos.create',
            'store' => 'puestos.store',
            'show' => 'puestos.show',
            'edit' => 'puestos.edit',
            'update' => 'puestos.update',
            'destroy' => 'puestos.destroy',
        ]);
        Route::resource('departamentos', DepartamentoController::class)->parameters([
            'departamentos' => 'departamento'
            ])->names([
                'index' => 'departamentos.index',
                'create' => 'departamentos.create',
                'store' => 'departamentos.store',
                'show' => 'departamentos.show',
                'edit' => 'departamentos.edit',
                'update' => 'departamentos.update',
                'destroy' => 'departamentos.destroy',
            ]);
        Route::resource('direcciones', DireccionController::class)->parameters([
            'direcciones' => 'direccion'
            ])->names([
                'index' => 'direcciones.index',
                'create' => 'direcciones.create',
                'store' => 'direcciones.store',
                'show' => 'direcciones.show',
                'edit' => 'direcciones.edit',
                'update' => 'direcciones.update',
                'destroy' => 'direcciones.destroy',
            ]);
                  
    Route::get('/gestion_puestos', [OverallController::class, 'dashboardPuestos'])->name('gestion_puestos');
});

Route::middleware(['auth', 'rol:admin,capacitador'])->group(function () {
    Route::get('/dashboard', [OverallController::class, 'dashboard']);
    Route::resource('examenes', ExamenController::class)->parameters([
        'examenes' => 'examen'
    ])->names([
        'index' => 'examenes.index',
        'create' => 'examenes.create',
        'store' => 'examenes.store',
        'show' => 'examenes.show',
        'edit' => 'examenes.edit',
        'update' => 'examenes.update',
        'destroy' => 'examenes.destroy',
    ]);
    Route::resource('examenes.preguntas', PreguntaController::class)->parameters([
        'examenes' => 'examen',
        'preguntas' => 'pregunta'
    ])->names([
        'index' => 'preguntas.index',
        'create' => 'preguntas.create',
        'store' => 'preguntas.store',
        'edit' => 'preguntas.edit',
        'update' => 'preguntas.update',
        'destroy' => 'preguntas.destroy',
    ]);
    Route::get('/gestion_examenes', [ExamenController::class, 'index'])->name('gestion_examenes');
    Route::resource('temas', TemaController::class)->parameters([
        'temas' => 'tema'
    ])->names([
        'index' => 'temas.index',
        'create' => 'temas.create',
        'store' => 'temas.store',
        'show' => 'temas.show',
        'edit' => 'temas.edit',
        'update' => 'temas.update',
        'destroy' => 'temas.destroy',
    ]);
    Route::resource('cursos', CursoController::class)->parameters([
        'cursos' => 'curso'
    ])->names([
        'index' => 'cursos.index',
        'create' => 'cursos.create',
        'store' => 'cursos.store',
        'show' => 'cursos.show',
        'edit' => 'cursos.edit',
        'update' => 'cursos.update',
        'destroy' => 'cursos.destroy',
    ]);
    Route::get('/gestion_temas', [OverallController::class, 'dashboardTemas'])->name('gestion_temas');
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
