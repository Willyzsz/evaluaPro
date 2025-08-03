<?php

namespace App\Http\Controllers;

use App\Models\ReticulaCurso;
use App\Models\ReticulaTema;
use App\Models\ReticulaExamen;
use App\Models\Reticula;
use App\Models\Examen;
use App\Models\Tema;
use App\Models\Curso;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class SubReticulaController extends Controller
{
    public function index(Request $request, Reticula $reticula): View
    {
        $reticula->load(['temas', 'examenes', 'cursos']);
    
        $itemsTemas = $reticula->temas->map(function($t) use ($reticula) {
            return (object)[
                'tipo'       => 'tema',
                'id'         => $t->idTema,
                'titulo'     => $t->nombre_tema,
                'detalle'    => $t->descripcion_tema ?? null,
                'link'       => route('temas.show', [$t->idTema, 'reticula'=> $reticula->idReticula]),
                'edit_link'  => route('subReticulas.edit',  ['reticula' => $reticula->idReticula, 'subReticula' => $t->idTema, 'tipo' => 'tema']),
                'delete_link'=> route('subReticulas.destroy', ['reticula' => $reticula->idReticula, 'subReticula' => $t->idTema, 'tipo' => 'tema']),        
            ];
        });
    
        $itemsExamenes = $reticula->examenes->map(function($e) use ($reticula) {
            return (object)[
                'tipo'       => 'examen',
                'id'         => $e->idExamen,
                'titulo'     => $e->nombre_examen,
                'detalle'    => optional($e->tema)->nombre_tema,
                'link'       => route('examenes.show', [$e->idExamen, 'reticula'=> $reticula->idReticula]),
                'edit_link'     => route('subReticulas.edit', ['reticula' => $reticula->idReticula, 'subReticula' => $e->idExamen, 'tipo' => 'examen']),
                'delete_link'   => route('subReticulas.destroy', ['reticula' => $reticula->idReticula, 'subReticula' => $e->idExamen, 'tipo' => 'examen']),
            ];
        });
    
        $itemsCursos = $reticula->cursos->map(function($c) use ($reticula) {
            return (object)[
                'tipo'       => 'curso',
                'id'         => $c->idCurso,
                'titulo'     => $c->nombre_curso,
                'detalle'    => $c->descripcion_curso ?? null,
                'link'       => route('cursos.show', [$c->idCurso, 'reticula'=> $reticula->idReticula]),
                'edit_link'     => route('subReticulas.edit', ['reticula' => $reticula->idReticula, 'subReticula' => $c->idCurso, 'tipo' => 'curso']),
                'delete_link'   => route('subReticulas.destroy', ['reticula' => $reticula->idReticula, 'subReticula' => $c->idCurso, 'tipo' => 'curso']),
            ];
        });
    
        $subReticulas = collect()
            ->merge($itemsTemas)
            ->merge($itemsExamenes)
            ->merge($itemsCursos)
            ->values();
    
        return view('dashboard.subReticulas.index', compact('reticula', 'subReticulas'));
    }
    

    public function create(Reticula $reticula): View
    {
        $temas = Tema::where('puesto_id', $reticula->puesto_id)->where('departamento_id', $reticula->departamento_id)->get();
        $temasIds = $temas->pluck('idTema');
        $examenes = Examen::whereIn('tema_id', $temasIds)->get();
        $cursos = Curso::all();
        return view('dashboard.subReticulas.create', compact('reticula', 'temas', 'examenes', 'cursos'));
    }

    public function store(Request $request, Reticula $reticula): RedirectResponse
    {
        // Reglas base
        $rules = [
            'tipo'       => ['required', Rule::in(['tema','examen','curso'])],
            'tema_id'    => ['nullable','exists:temas,idTema'],
            'examen_id'  => ['nullable','exists:examenes,idExamen'],
            'curso_id'   => ['nullable','exists:cursos,idCurso'],
        ];
    
        // Reglas según el tipo seleccionado
        if ($request->tipo === 'tema') {
            $rules['tema_id'][] = 'required';
            $rules['tema_id'][] = Rule::unique('reticulas_temas', 'tema_id')
                ->where(fn($q) => $q->where('reticula_id', $reticula->idReticula));
        }
    
        if ($request->tipo === 'examen') {
            $rules['examen_id'][] = 'required';
            $rules['examen_id'][] = Rule::unique('reticulas_examenes', 'examen_id')
                ->where(fn($q) => $q->where('reticula_id', $reticula->idReticula));
        }
    
        if ($request->tipo === 'curso') {
            $rules['curso_id'][] = 'required';
            $rules['curso_id'][] = Rule::unique('reticulas_cursos', 'curso_id')
                ->where(fn($q) => $q->where('reticula_id', $reticula->idReticula));
        }
    
        $validated = $request->validate($rules);
    
        try {
            if ($request->tipo === 'tema') {
                ReticulaTema::create([
                    'reticula_id' => $reticula->idReticula,
                    'tema_id'     => $request->tema_id,
                ]);
            } elseif ($request->tipo === 'examen') {
                ReticulaExamen::create([
                    'reticula_id' => $reticula->idReticula,
                    'examen_id'   => $request->examen_id,
                ]);
            } else { // curso
                ReticulaCurso::create([
                    'reticula_id' => $reticula->idReticula,
                    'curso_id'    => $request->curso_id,
                ]);
            }
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('subReticulas.index', $reticula)
                ->with('error', 'Ya existe este elemento en la retícula.');
            }
            throw $e;
        }
    
        return redirect()
            ->route('subReticulas.index', $reticula)
            ->with('success', 'Elemento añadido exitosamente.');
    }
    

    public function edit(Reticula $reticula, $subReticula, Request $request): View
    {
        $tipo = $request->query('tipo');
        if (! in_array($tipo, ['tema','examen','curso'], true)) {
            abort(404);
        }
        $temas = Tema::where('puesto_id', $reticula->puesto_id)->where('departamento_id', $reticula->departamento_id)->get();
        $temasIds = $temas->pluck('idTema');
        $examenes = Examen::whereIn('tema_id', $temasIds)->get();
        $cursos = Curso::all();

        $pivot = null;
        $selectedTemaId = $selectedExamenId = $selectedCursoId = null;
        $idSubReticula = null;

        if ($tipo === 'tema') {
            $pivot = ReticulaTema::with('tema.puesto','tema.departamento')
                ->where('reticula_id', $reticula->idReticula)
                ->where('tema_id', $subReticula)
                ->firstOrFail();
    
            $idSubReticula = $pivot->idReticulaTema;
            $selectedTemaId = $pivot->tema_id;
    
        } elseif ($tipo === 'examen') {
            $pivot = ReticulaExamen::with('examen.tema')
                ->where('reticula_id', $reticula->idReticula)
                ->where('examen_id', $subReticula)
                ->firstOrFail();
    
            $idSubReticula = $pivot->idReticulaExamen;
            $selectedExamenId = $pivot->examen_id;
    
        } else { 
            $pivot = ReticulaCurso::with('curso')
                ->where('reticula_id', $reticula->idReticula)
                ->where('curso_id', $subReticula)
                ->firstOrFail();
    
            $idSubReticula = $pivot->idReticulaCurso;
            $selectedCursoId = $pivot->curso_id;
        }
        return view('dashboard.subReticulas.edit', compact(
            'reticula',
            'temas',
            'examenes',
            'cursos',
            'idSubReticula', 
            'tipo',
            'selectedTemaId',
            'selectedExamenId',
            'selectedCursoId',
        ));
    }

    public function update(Request $request, Reticula $reticula, $idSubReticula): RedirectResponse
    {
        $request->validate([
            'tipo' => 'required|in:tema,examen,curso',
            'original_tipo' => 'required|in:tema,examen,curso',
            'tema_id' => 'nullable|exists:temas,idTema',
            'examen_id' => 'nullable|exists:examenes,idExamen',
            'curso_id' => 'nullable|exists:cursos,idCurso',

        ]);

        DB::transaction(function () use ($request, $reticula, $idSubReticula) {
            $original = $request->original_tipo;
            $nuevo    = $request->tipo;
            if ($nuevo === $original) {
                // Solo actualizar dentro de la misma tabla pivote
                switch ($nuevo) {
                    case 'tema':
                        ReticulaTema::where('idReticulaTema', $idSubReticula)
                            ->update(['tema_id' => $request->tema_id]);
                        break;
    
                    case 'examen':
                        ReticulaExamen::where('idReticulaExamen', $idSubReticula)
                            ->update(['examen_id' => $request->examen_id]);
                        break;
    
                    case 'curso':
                        ReticulaCurso::where('idReticulaCurso', $idSubReticula)
                            ->update(['curso_id' => $request->curso_id]);
                        break;
                }
            } else {
                switch ($original) {
                    case 'tema':
                        ReticulaTema::where('idReticulaTema', $idSubReticula)->delete();
                        break;
                    case 'examen':
                        ReticulaExamen::where('idReticulaExamen', $idSubReticula)->delete();
                        break;
                    case 'curso':
                        ReticulaCurso::where('idReticulaCurso', $idSubReticula)->delete();
                        break;
                }
    
                switch ($nuevo) {
                    case 'tema':
                        ReticulaTema::firstOrCreate([
                            'reticula_id' => $reticula->idReticula,
                            'tema_id'     => $request->tema_id,
                        ]);
                        break;
    
                    case 'examen':
                        ReticulaExamen::firstOrCreate([
                            'reticula_id' => $reticula->idReticula,
                            'examen_id'   => $request->examen_id,
                        ]);
                        break;
    
                    case 'curso':
                        ReticulaCurso::firstOrCreate([
                            'reticula_id' => $reticula->idReticula,
                            'curso_id'    => $request->curso_id,
                        ]);
                        break;
                }
            }
        });
        return redirect()->route('subReticulas.index', $reticula)->with('success', 'Elemento actualizado exitosamente.');
    }
    
    public function destroy(Request $request, Reticula $reticula, $subReticula): RedirectResponse
    {
        $tipo = $request->query('tipo'); 
    
        if (!in_array($tipo, ['tema', 'examen', 'curso'], true)) {
            return redirect()
                ->route('subReticulas.index', $reticula)
                ->with('error', 'Tipo inválido.');
        }
    
        try {
            switch ($tipo) {
                case 'tema':
                    $pivot = ReticulaTema::where('reticula_id', $reticula->idReticula)
                        ->where('tema_id', $subReticula)
                        ->first();
                    break;
    
                case 'examen':
                    $pivot = ReticulaExamen::where('reticula_id', $reticula->idReticula)
                        ->where('examen_id', $subReticula)
                        ->first();
                    break;
    
                case 'curso':
                    $pivot = ReticulaCurso::where('reticula_id', $reticula->idReticula)
                        ->where('curso_id', $subReticula)
                        ->first();
                    break;
            }
    
            if (!$pivot) {
                return redirect()
                    ->route('subReticulas.index', $reticula)
                    ->with('error', 'El elemento no existe en esta retícula.');
            }
    
            $pivot->delete();
    
            return redirect()
                ->route('subReticulas.index', $reticula)
                ->with('success', 'Elemento eliminado exitosamente.');
        } catch (QueryException $e) {
            if ((string) $e->getCode() === '23000') {
                return redirect()
                    ->route('subReticulas.index', $reticula)
                    ->with('error', 'No se puede eliminar porque está relacionado con otros registros.');
            }
            throw $e;
        }
    }
    
}