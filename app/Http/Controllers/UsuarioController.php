<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Puesto;
use App\Models\Departamento;
use App\Models\Examen;
use App\Models\Pregunta;
use App\Models\Reticula;
use App\Models\SubReticula;
use App\Models\ReticulaTema;
use App\Models\ReticulaExamen;
use App\Models\ReticulaCurso;
use App\Models\ExamenRealizado;
use App\Models\RespuestaUsuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\QueryException;

class UsuarioController extends Controller
{
    private function getReticulaData(\App\Models\Usuario $usuario): array
    {
        $puesto = Puesto::find($usuario->puesto_usuario);

        $reticula = Reticula::with(['temas', 'examenes', 'cursos'])
            ->where('puesto_id', $puesto->idPuesto)
            ->where('departamento_id', $puesto->departamento_id)
            ->first();

        $examenesRealizados = ExamenRealizado::where('usuario_id', $usuario->idUsuario)
            ->whereIn('examen_id', $reticula->examenes->pluck('idExamen'))
            ->pluck('examen_id')
            ->toArray();
        
        $itemsTemas = $reticula->temas->map(function($t) {
            return (object)[
                'tipo'    => 'tema',
                'id'      => $t->idTema,
                'titulo'  => $t->nombre_tema,
                'detalle' => $t->descripcion_tema ?? null,
                'link'    => $t->tema_url,
            ];
        });

        $itemsExamenes = $reticula->examenes->map(function($e) {
            return (object)[
                'tipo'    => 'examen',
                'id'      => $e->idExamen,
                'titulo'  => $e->nombre_examen,
                'detalle' => optional($e->tema)->nombre_tema,
                'link'    => route('generales', $e->idExamen),
            ];
        });

        $itemsCursos = $reticula->cursos->map(function($c) {
            return (object)[
                'tipo'    => 'curso',
                'id'      => $c->idCurso,
                'titulo'  => $c->nombre_curso,
                'detalle' => $c->descripcion_curso ?? null,
                'link'    => $c->curso_url,
            ];
        });

        $subReticulas = collect()
            ->merge($itemsTemas)
            ->merge($itemsExamenes)
            ->merge($itemsCursos)
            ->values();

        return compact('reticula', 'subReticulas', 'examenesRealizados');
    }

    public function index(): View
    {
        $usuario = auth()->user();
        return view('welcome', compact('usuario'));
    }
    public function reticula(): View
    {
        $usuario = auth()->user();
        $data = $this->getReticulaData($usuario);
        return view('generales.reticulas', $data);
    }

    public function examen(Examen $examen): View {
        $preguntas = Pregunta::where('examen_id', $examen->idExamen)->get();
        $totalPuntos = $preguntas->sum('puntos');
        return view('generales.examen', compact('preguntas', 'examen', 'totalPuntos'));
    }

    public function respuesta(Request $request, Examen $examen)
    {
        $request->validate([
            'respuestas' => ['required','array'],
            'respuestas.*' => ['required','string'], 
        ]);
        $respuestas = $request->input('respuestas', []);
        $usuario = auth()->user();
        $data = $this->getReticulaData($usuario);

        $examenRealizado = ExamenRealizado::firstOrCreate([
            'usuario_id' => $usuario->idUsuario,
            'examen_id' => $examen->idExamen,
        ]);

        foreach ($respuestas as $preguntaId => $respuesta) {
            $respuestaCorrecta = Pregunta::where('idPregunta', $preguntaId)
                ->value('respuesta_correcta');

            $correcta = $respuestaCorrecta === $respuesta;
        
            RespuestaUsuario::create([
                'examen_realizado_id' => $examenRealizado->idExamenRealizado,
                'pregunta_id' => $preguntaId,
                'respuesta' => $respuesta,
                'correcta' => $correcta,
            ]);
        }
        
        return redirect('/reticula_usuario');
    }

    public function resultados(): View {    
        $usuario = auth()->user();

        $examenesRealizados = ExamenRealizado::with(['examen'])
            ->where('usuario_id', $usuario->idUsuario)
            ->get();

        return view('generales.resultados', compact('examenesRealizados'));
    }

    public function resultadoExamen(Examen $examen): View {
        
        $preguntas = Pregunta::where('examen_id', $examen->idExamen)->get();
        $totalPuntos = $preguntas->sum('puntos');

        $usuario = auth()->user();

        $examenRealizado = ExamenRealizado::where('usuario_id', $usuario->idUsuario)
        ->where('examen_id', $examen->idExamen)->first();
    

        $respuestasUsuario = RespuestaUsuario::with('examenRealizado')
        ->whereHas('examenRealizado', function ($query) use ($usuario, $examen) {
            $query->where('usuario_id', $usuario->idUsuario)
                  ->where('examen_id', $examen->idExamen);
        })
        ->get();
        
        $preguntasAbiertas = $preguntas->where('tipo', 'abierta');
        $faltaCalificar = false;
        
        if ($preguntasAbiertas->isNotEmpty()) {
            if ($respuestasUsuario->isEmpty()) {
                $faltaCalificar = true;
            } else {
                $faltan = $preguntasAbiertas->filter(function ($pregunta) use ($respuestasUsuario) {
                    $respuesta = $respuestasUsuario->firstWhere('pregunta_id', $pregunta->idPregunta);
                    return !$respuesta || is_null($respuesta->correcta);
                });
                $faltaCalificar = $faltan->isNotEmpty();
            }
        }

    return view('generales.resultado_examen', compact('preguntas', 'examen', 'totalPuntos', 'respuestasUsuario', 'examenRealizado', 'faltaCalificar'));
    }
}