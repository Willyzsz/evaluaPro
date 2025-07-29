<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Curso;
use App\Models\Puesto;
use App\Models\Departamento;
use App\Models\Tema;


class TemaController extends Controller
{

    public function index(Request $request): View
    {
        $search = $request->get('search');
        $temas = Tema::with('curso', 'puesto', 'departamento')
        ->when($search, function($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nombre_tema', 'LIKE', "%{$search}%")
                  ->orWhereHas('curso', function($cursoQuery) use ($search) {
                      $cursoQuery->where('nombre_curso', 'LIKE', "%{$search}%");
                  })
                  ->orWhereHas('puesto', function($puestoQuery) use ($search) {
                      $puestoQuery->where('nombre_puesto', 'LIKE', "%{$search}%");
                  })
                  ->orWhereHas('departamento', function($depQuery) use ($search) {
                      $depQuery->where('nombre_departamento', 'LIKE', "%{$search}%");
                  });
            });
        })
        ->get();
        return view('dashboard.temas', compact('temas'));
    }

    public function create(): View
    {
        $cursos = Curso::all();
        $puestos = Puesto::all();
        $departamentos = Departamento::all();
        return view('dashboard.temas.create', compact('cursos', 'puestos', 'departamentos'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre_tema' => 'required|string|max:255',
            'descripcion_tema' => 'nullable|string',
            'tema_url' => 'nullable',
            'curso_id' => 'nullable|exists:cursos,idCurso',
            'puesto_id' => 'required|exists:puestos,idPuesto',
            'departamento_id' => 'required|exists:departamentos,idDepartamento',
        ]);

        Tema::create([
            'nombre_tema' => $request->nombre_tema,
            'descripcion_tema' => $request->descripcion_tema,
            'tema_url' => $request->tema_url,
            'curso_id' => $request->curso_id,
            'puesto_id' => $request->puesto_id,
            'departamento_id' => $request->departamento_id,
        ]);

        return redirect()->route('temas.index')->with('success', 'Tema creado exitosamente.');
    }

    public function show(Tema $tema): View
    {
        $tema->load('curso', 'puesto', 'departamento');
        return view('dashboard.temas.show', compact('tema'));
    }

    public function edit(Tema $tema): View
    {
        $cursos = Curso::all();
        $puestos = Puesto::all();
        $departamentos = Departamento::all();
        return view('dashboard.temas.edit', compact('tema', 'cursos', 'puestos', 'departamentos'));
    }

    public function update(Request $request, Tema $tema): RedirectResponse
    {
        $request->validate([
            'nombre_tema' => 'required|string|max:255',
            'descripcion_tema' => 'nullable|string',
            'tema_url' => 'nullable',
            'curso_id' => 'nullable|exists:cursos,idCurso',
            'puesto_id' => 'required|exists:puestos,idPuesto',
            'departamento_id' => 'required|exists:departamentos,idDepartamento',

        ]);

        $tema->update([
            'nombre_tema' => $request->nombre_tema,
            'descripcion_tema' => $request->descripcion_tema,
            'tema_url' => $request->tema_url,
            'curso_id' => $request->curso_id,
            'puesto_id' => $request->puesto_id,
            'departamento_id' => $request->departamento_id,

        ]);

        return redirect()->route('temas.index')->with('success', 'Tema actualizado exitosamente.');
    }

    public function destroy(Tema $tema): RedirectResponse
    {
        try {
            $tema->delete();
            return redirect()->route('tema.index')
                ->with('success', 'Puesto eliminado exitosamente.');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('tema.index')
                    ->with('error', 'No se puede eliminar el tema porque está relacionada con otros registros.');
            }
        }
    }

}