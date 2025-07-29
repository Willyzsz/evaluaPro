<?php

namespace App\Http\Controllers;

use App\Models\Reticula;
use App\Models\Tema;
use App\Models\Examen;
use App\Models\Puesto;
use App\Models\Departamento;
use App\Models\Curso;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Database\QueryException;

class ReticulaController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->get('search');
        $reticulas = Reticula::with('tema', 'examen', 'puesto', 'departamento', 'curso')
        ->when($search, function($query) use ($search) {
          $query->where(function ($q) use ($search) {
            $q->where('nombre_reticula', 'LIKE', "%{$search}%")
            ->orWhereHas('tema', function($temaQuery) use ($search) {
                $temaQuery->where('nombre_tema', 'LIKE', "%{$search}%");
            })
            ->orWhereHas('examen', function($examenQuery) use ($search) {
                $examenQuery->where('nombre_examen', 'LIKE', "%{$search}%");
            })
            ->orWhereHas('puesto', function($puestoQuery) use ($search) {
                $puestoQuery->where('nombre_puesto', 'LIKE', "%{$search}%");
            })
            ->orWhereHas('departamento', function($departamentoQuery) use ($search) {
                $departamentoQuery->where('nombre_departamento', 'LIKE', "%{$search}%");
            })
            ->orWhereHas('curso', function($cursoQuery) use ($search) {
                $cursoQuery->where('nombre_curso', 'LIKE', "%{$search}%");
            });
          });
        })
        ->get();
        return view('dashboard.reticulas', compact('reticulas'));
    }

    public function create(): View
    {
        $temas = Tema::all();
        $examenes = Examen::all();
        $puestos = Puesto::all();
        $departamentos = Departamento::all();
        $cursos = Curso::all();
        return view('dashboard.reticulas.create', compact('temas', 'examenes', 'puestos', 'departamentos', 'cursos'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre_reticula' => 'required|string|max:255',
            'tema_id' => 'required|exists:temas,idTema',
            'examen_id' => 'required|exists:examenes,idExamen',
            'puesto_id' => 'required|exists:puestos,idPuesto',
            'departamento_id' => 'required|exists:departamentos,idDepartamento',
            'curso_id' => 'nullable|exists:cursos,idCurso', 
        ]);

        Reticula::create([
            'nombre_reticula' => $request->nombre_reticula,
            'tema_id' => $request->tema_id,
            'examen_id' => $request->examen_id,
            'puesto_id' => $request->puesto_id,
            'departamento_id' => $request->departamento_id,
            'curso_id' => $request->curso_id,
        ]);

        return redirect()->route('reticulas.index')->with('success', 'Reticula creado exitosamente.');
    }

    public function show(Reticula $reticula): View
    {
        $reticula->load('tema');
        $reticula->load('examen');
        $reticula->load('puesto');
        $reticula->load('departamento');
        $reticula->load('curso');
        return view('dashboard.reticulas.show', compact('reticula'));
    }

    public function edit(Reticula $reticula): View
    {
        $temas = Tema::all();
        $examenes = Examen::all();
        $puestos = Puesto::all();
        $departamentos = Departamento::all();
        $cursos = Curso::all();
        return view('dashboard.reticulas.edit', compact('reticula', 'temas', 'examenes', 'puestos', 'departamentos', 'cursos'));
    }

    public function update(Request $request, Reticula $reticula): RedirectResponse
    {
        $request->validate([
            'nombre_reticula' => 'required|string|max:255',
            'tema_id' => 'required|exists:temas,idTema',
            'examen_id' => 'required|exists:examenes,idExamen',
            'puesto_id' => 'required|exists:puestos,idPuesto',
            'departamento_id' => 'required|exists:departamentos,idDepartamento',
            'curso_id' => 'nullable|exists:cursos,idCurso', 
        ]);

        $reticula->update([
            'nombre_reticula' => $request->nombre_reticula,
            'tema_id' => $request->tema_id,
            'examen_id' => $request->examen_id,
            'puesto_id' => $request->puesto_id,
            'departamento_id' => $request->departamento_id,
            'curso_id' => $request->curso_id,
        ]);

        return redirect()->route('reticulas.index')->with('success', 'Reticula actualizado exitosamente.');
    }

    public function destroy(Reticula $reticula): RedirectResponse
    {
        try {
            $reticula->delete();
            return redirect()->route('reticula.index')
                ->with('success', 'Reticula eliminada exitosamente.');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('reticula.index')
                    ->with('error', 'No se puede eliminar la reticula porque está relacionada con otros registros.');
            }
        }
    }
}