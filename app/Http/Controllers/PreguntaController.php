<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use App\Models\Examen;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Database\QueryException;

class PreguntaController extends Controller
{
    public function index(Request $request, Examen $examen): View
    {
        $preguntas = Pregunta::where('examen_id', $examen->idExamen)->get();
        $totalPuntos = $preguntas->sum('puntos');
        return view('dashboard.preguntas.index', compact('preguntas', 'examen', 'totalPuntos'));
    }

    public function create(Examen $examen): View
    {
        return view('dashboard.preguntas.create', compact('examen'));
    }

    public function store(Request $request, Examen $examen): RedirectResponse
    {
        $request->validate([
            'texto' => 'required|string|max:500',
            'tipo' => 'required|in:opcion_multiple,verdadero_falso,abierta',
            'opciones' => 'nullable|string',
            'respuesta_correcta' => 'nullable|string|max:255',
            'imagen' => 'nullable|image|max:2048',
            'puntos' => 'required|numeric|min:0',

        ]);

        $opciones = null;
        if ($request->tipo === 'opcion_multiple' && $request->opciones) {
            $lineas = explode("\n", trim($request->opciones));
            $opcionesFormateadas = [];
        
            foreach ($lineas as $linea) {
                $linea = trim($linea);
                if (preg_match('/^([A-Da-d])\)?\s*(.+)$/', $linea, $matches)) {
                    $letra = strtoupper($matches[1]);
                    $texto = $matches[2];
                    $opcionesFormateadas[$letra] = $texto;
                }
            }
        
            $opciones = json_encode($opcionesFormateadas, JSON_UNESCAPED_UNICODE);
        }
        
        $imagenPath = null;
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('preguntas', 'public');
        }
        
        Pregunta::create([
            'examen_id' => $examen->idExamen,
            'texto' => $request->texto,
            'tipo' => $request->tipo,
            'opciones' => $opciones,
            'respuesta_correcta' => $request->respuesta_correcta,
            'imagen' => $imagenPath,
            'puntos' => $request->puntos,
        ]);

        return redirect()->route('preguntas.index', $examen)->with('success', 'Pregunta creada exitosamente.');
    }

    public function edit(Examen $examen, Pregunta $pregunta): View
    {
        return view('dashboard.preguntas.edit', compact('pregunta', 'examen'));
    }

    public function update(Request $request, Examen $examen, Pregunta $pregunta): RedirectResponse
    {
        $request->validate([
            'texto' => 'required|string|max:500',
            'tipo' => 'required|in:opcion_multiple,verdadero_falso,abierta',
            'opciones' => 'nullable|string',
            'respuesta_correcta' => 'nullable|string|max:255',
            'imagen' => 'nullable|image|max:2048',
            'puntos' => 'required|numeric|min:0',
        ]);

        $opciones = null;
        if ($request->tipo === 'opcion_multiple' && $request->opciones) {
            $lineas = explode("\n", trim($request->opciones));
            $opcionesFormateadas = [];
        
            foreach ($lineas as $linea) {
                $linea = trim($linea);
                if (preg_match('/^([A-Da-d])\)?\s*(.+)$/', $linea, $matches)) {
                    $letra = strtoupper($matches[1]);
                    $texto = $matches[2];
                    $opcionesFormateadas[$letra] = $texto;
                }
            }
        
            $opciones = json_encode($opcionesFormateadas, JSON_UNESCAPED_UNICODE);
        }
        
        $imagenPath = null;
        if ($pregunta->imagen) {
            $imagenPath = $pregunta->imagen;
        }
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('preguntas', 'public');
        }

        $pregunta->update([
            'texto' => $request->texto,
            'tipo' => $request->tipo,
            'opciones' => $opciones,
            'respuesta_correcta' => $request->respuesta_correcta,
            'imagen' => $imagenPath,
            'puntos' => $request->puntos,
        ]);

        return redirect()->route('preguntas.index', $examen)->with('success', 'Pregunta actualizada exitosamente.');
    }

    public function destroy(Examen $examen, Pregunta $pregunta): RedirectResponse
    {
        try {
            $pregunta->delete();
            return redirect()->route('preguntas.index', $examen)
                ->with('success', 'Pregunta eliminada exitosamente.');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('preguntas.index', $examen)
                    ->with('error', 'No se puede eliminar la pregunta porque está relacionada con otros registros.');
            }
        }
    }
}