<?php

namespace App\Http\Controllers;

use App\Models\Examen;
use App\Models\Usuario;
use App\Models\Tema;
use App\Models\ExamenRealizado;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Database\QueryException;
use App\Models\SubReticula;
use App\Models\ReticulaTema;
use App\Models\ReticulaExamen;
use App\Models\ReticulaCurso;
use App\Models\RespuestaUsuario;
use App\Models\Puesto;
use App\Models\Departamento;
use App\Models\Pregunta;

class RevisarController extends Controller
{
    private function getReticulaData(\App\Models\Usuario $usuario): array {
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
    
    public function index(Request $request): View
    {
        $usuario = auth()->user(); 
        $search = $request->get('search');
        $estatusFilter = $request->get('estatus_filter', 'none');
        
        $usuarios = Usuario::with('puesto.departamento')
            ->where('rol_usuario', '!=', 'admin')
            ->where('idUsuario', '!=', $usuario->idUsuario)
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('usuario', 'LIKE', "%{$search}%")
                      ->orWhere('rol_usuario', 'LIKE', "%{$search}%")
                      ->orWhereHas('puesto', function ($puestoQuery) use ($search) {
                          $puestoQuery->where('nombre_puesto', 'LIKE', "%{$search}%")
                                     ->orWhereHas('departamento', function ($deptQuery) use ($search) {
                                         $deptQuery->where('nombre_departamento', 'LIKE', "%{$search}%");
                                     });
                          });
                });
            })
            ->when($estatusFilter !== 'none', function ($query) use ($estatusFilter) {
                $query->where('estatus', $estatusFilter);
            })
            ->get();
            
        return view('dashboard.revisar.usuarios', compact('usuarios', 'estatusFilter'));
    }

    public function show(Usuario $usuario): View
    {
        $usuario->load('puesto.departamento');
        return view('dashboard.revisar.show', compact('usuario'));
    }

    public function examenesRevision(Usuario $usuario): View
    {
        $examenesRealizados = ExamenRealizado::with(['examen'])
            ->where('usuario_id', $usuario->idUsuario)
            ->get();
        
        return view('dashboard.revisar.examen', compact('examenesRealizados', 'usuario'));
    }
    
    public function infoExamen(Usuario $usuario, Examen $examen): View {
        
        $preguntas = Pregunta::where('examen_id', $examen->idExamen)->get();
        $totalPuntos = $preguntas->sum('puntos');

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

    return view('dashboard.revisar.infoExamen', compact('preguntas', 'examen', 'totalPuntos', 'respuestasUsuario', 'examenRealizado', 'faltaCalificar', 'usuario'));
    }
    
    public function update(Request $request, Usuario $usuario, Examen $examen): RedirectResponse
    {
        $usuarioCalificador = auth()->user();
    
        $request->validate([
            'calificaciones' => 'nullable|array',
            'calificaciones.*' => 'numeric|min:0',
        ]);
    
        $examenRealizado = ExamenRealizado::where('examen_id', $examen->idExamen)
            ->where('usuario_id', $usuario->idUsuario)
            ->firstOrFail();
    
        $total = 0;
    
        if ($request->has('calificaciones')) {
            foreach ($request->calificaciones as $respuestaId => $valor) {
                $respuesta = RespuestaUsuario::find($respuestaId);
                if ($respuesta) {
                    $respuesta->correcta = $valor > 0 ? 1 : 0;
                    $respuesta->valor_otorgado = $valor;
                    $respuesta->save();
    
                    $total += $valor;
                }
            }
        }
    
        $respuestasCerradas = RespuestaUsuario::where('examen_realizado_id', $examenRealizado->idExamenRealizado)
            ->where('correcta', 1)
            ->whereNull('valor_otorgado')
            ->get();
    
        foreach ($respuestasCerradas as $respuesta) {
            $total += $respuesta->pregunta->puntos;
        }
    
        // Actualizar ExamenRealizado
        $examenRealizado->update([
            'calificacion' => $total,
            'usuario_Calificador' => $usuarioCalificador->idUsuario,
        ]);
    
        return redirect()->route('revisar_usuario_examen', $usuario)
            ->with('success', 'Examen actualizado exitosamente con calificación: ' . $total);
    }

    
}