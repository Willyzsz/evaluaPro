<?php

namespace App\Http\Controllers;

use App\Models\Examen;
use App\Models\Tema;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Database\QueryException;

class ExamenController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->get('search');
        $examenes = Examen::with('tema')
        ->when($search, function($query) use ($search) {
          $query->where(function ($q) use ($search) {
            $q->where('nombre_examen', 'LIKE', "%{$search}%")
            ->orWhereHas('tema', function($temaQuery) use ($search) {
                $temaQuery->where('nombre_tema', 'LIKE', "%{$search}%");
            });
          });
        })
        ->get();
        return view('dashboard.examenes', compact('examenes'));
    }

    public function create(): View
    {
        $temas = Tema::all();
        return view('dashboard.examenes.create', compact('temas'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre_examen' => 'required|string|max:255',
            'descripcion_examen' => 'nullable|string',
            'duracion_examen' => 'nullable|integer|min:1',
            'tema_id' => 'required|exists:temas,idTema',
        ]);

        Examen::create([
            'nombre_examen' => $request->nombre_examen,
            'descripcion_examen' => $request->descripcion_examen,
            'duracion_examen' => $request->duracion_examen,
            'tema_id' => $request->tema_id,
        ]);

        return redirect()->route('examenes.index')->with('success', 'Examen creado exitosamente.');
    }

    public function show(Examen $examen): View
    {
        $examen->load('tema');
        return view('dashboard.examenes.show', compact('examen'));
    }

    public function edit(Examen $examen): View
    {
        $temas = Tema::all();
        return view('dashboard.examenes.edit', compact('examen', 'temas'));
    }

    public function update(Request $request, Examen $examen): RedirectResponse
    {
        $request->validate([
            'nombre_examen' => 'required|string|max:255',
            'descripcion_examen' => 'nullable|string',
            'duracion_examen' => 'nullable|integer|min:1',
            'tema_id' => 'required|exists:temas,idTema',
        ]);

        $examen->update([
            'nombre_examen' => $request->nombre_examen,
            'descripcion_examen' => $request->descripcion_examen,
            'duracion_examen' => $request->duracion_examen,
            'tema_id' => $request->tema_id,
        ]);

        return redirect()->route('examenes.index')->with('success', 'Examen actualizado exitosamente.');
    }

    public function destroy(Examen $examen): RedirectResponse
    {
        try {
            $examen->delete();
            return redirect()->route('examen.index')
                ->with('success', 'Puesto eliminado exitosamente.');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('examen.index')
                    ->with('error', 'No se puede eliminar el examen porque está relacionada con otros registros.');
            }
        }
    }
}