<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Curso;
use Illuminate\Database\QueryException;


class CursoController extends Controller
{

    public function index(Request $request): View
    {
        $search = $request->get('search');
        $cursos = Curso::query()
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nombre_curso', 'LIKE', "%{$search}%");
            });
        })
        ->get();
    
        return view('dashboard.cursos', compact('cursos'));
    }

    public function create(): View
    {
        $cursos = Curso::all();
        return view('dashboard.cursos.create', compact('cursos'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre_curso' => 'required|string|max:255',
            'descripcion_curso' => 'nullable|string',
            'curso_url' => 'nullable|string',
        ]);

        Curso::create([
            'nombre_curso' => $request->nombre_curso,
            'descripcion_curso' => $request->descripcion_curso,
            'curso_url' => $request->curso_url,
        ]);

        return redirect()->route('cursos.index')->with('success', 'Curso creado exitosamente.');
    }

    public function show(Curso $curso): View
    {
        
        return view('dashboard.cursos.show', compact('curso'));
    }

    public function edit(Curso $curso): View
    {
        return view('dashboard.cursos.edit', compact('curso'));
    }

    public function update(Request $request, Curso $curso): RedirectResponse
    {
        $request->validate([
            'nombre_curso' => 'required|string|max:255',
            'descripcion_curso' => 'nullable|string',
            'curso_url' => 'nullable|string',
        ]);

        $curso->update([
            'nombre_curso' => $request->nombre_curso,
            'descripcion_curso' => $request->descripcion_curso,
            'curso_url' => $request->curso_url,
        ]);

        return redirect()->route('cursos.index')->with('success', 'Curso actualizada exitosamente.');
    }

    public function destroy(Curso $curso): RedirectResponse
    {
        try {
            $curso->delete();
            return redirect()->route('cursos.index')
                ->with('success', 'Curso eliminada exitosamente.');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('cursos.index')
                    ->with('error', 'No se puede eliminar el Curso porque está relacionada con otros registros.');
            }
        }
    }
}