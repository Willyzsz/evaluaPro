<?php

namespace App\Http\Controllers;

use App\Models\Examen;
use App\Models\Tema;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ExamenController extends Controller
{
    public function index(): View
    {
        $examenes = Examen::with('tema')->get();
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
        $examen->delete();
        return redirect()->route('examenes.index')->with('success', 'Examen eliminado exitosamente.');
    }
}