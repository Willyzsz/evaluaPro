<?php

namespace App\Http\Controllers;

use App\Models\Reticula;
use App\Models\Puesto;
use App\Models\Departamento;
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
        $reticulas = Reticula::with('puesto', 'departamento')
        ->when($search, function($query) use ($search) {
          $query->where(function ($q) use ($search) {
            $q->where('nombre_reticula', 'LIKE', "%{$search}%")
            ->orWhereHas('puesto', function($puestoQuery) use ($search) {
                $puestoQuery->where('nombre_puesto', 'LIKE', "%{$search}%");
            })
            ->orWhereHas('departamento', function($departamentoQuery) use ($search) {
                $departamentoQuery->where('nombre_departamento', 'LIKE', "%{$search}%");
            });
          });
        })
        ->get();
        return view('dashboard.reticulas', compact('reticulas'));
    }

    public function create(): View
    {
        $puestos = Puesto::all();
        $departamentos = Departamento::all();
        return view('dashboard.reticulas.create', compact('puestos', 'departamentos'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre_reticula' => 'required|string|max:255',
            'puesto_id' => 'required|exists:puestos,idPuesto',
            'departamento_id' => 'required|exists:departamentos,idDepartamento', 
        ]);

        Reticula::create([
            'nombre_reticula' => $request->nombre_reticula,
            'puesto_id' => $request->puesto_id,
            'departamento_id' => $request->departamento_id,
        ]);

        return redirect()->route('reticulas.index')->with('success', 'Reticula creado exitosamente.');
    }

    public function show(Reticula $reticula): View
    {
        $reticula->load('puesto');
        $reticula->load('departamento');
        return view('dashboard.reticulas.show', compact('reticula'));
    }

    public function edit(Reticula $reticula): View
    {
        $puestos = Puesto::all();
        $departamentos = Departamento::all();
        return view('dashboard.reticulas.edit', compact('reticula', 'puestos', 'departamentos'));
    }

    public function update(Request $request, Reticula $reticula): RedirectResponse
    {
        $request->validate([
            'nombre_reticula' => 'required|string|max:255',
            'puesto_id' => 'required|exists:puestos,idPuesto',
            'departamento_id' => 'required|exists:departamentos,idDepartamento',
        ]);

        $reticula->update([
            'nombre_reticula' => $request->nombre_reticula,
            'puesto_id' => $request->puesto_id,
            'departamento_id' => $request->departamento_id,
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