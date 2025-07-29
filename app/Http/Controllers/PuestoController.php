<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Puesto;
use App\Models\Departamento;


class PuestoController extends Controller
{

    public function index(Request $request): View
    {
        $search = $request->get('search');
        $puestos = Puesto::with('departamento')
        ->when($search, function($query) use ($search) {
          $query->where(function ($q) use ($search) {
            $q->where('nombre_puesto', 'LIKE', "%{$search}%")
            ->orWhereHas('departamento', function($departamentoQuery) use ($search) {
                $departamentoQuery->where('nombre_departamento', 'LIKE', "%{$search}%");
            });
          });
        })
        ->get();
        return view('admin.puestos', compact('puestos'));
    }

    public function create(): View
    {
        $departamentos = Departamento::all();
        return view('admin.puestos.create', compact('departamentos'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre_puesto' => 'required|string|max:255',
            'descripcion_puesto' => 'nullable|string',
            'departamento_id' => 'required|exists:departamentos,idDepartamento',
        ]);

        Puesto::create([
            'nombre_puesto' => $request->nombre_puesto,
            'descripcion_puesto' => $request->descripcion_puesto,
            'departamento_id' => $request->departamento_id,
        ]);

        return redirect()->route('puestos.index')->with('success', 'Puesto creado exitosamente.');
    }

    public function show(Puesto $puesto): View
    {
        $puesto->load('departamento');
        return view('admin.puestos.show', compact('puesto'));
    }

    public function edit(Puesto $puesto): View
    {
        $departamentos = Departamento::all();
        return view('admin.puestos.edit', compact('puesto', 'departamentos'));
    }

    public function update(Request $request, Puesto $puesto): RedirectResponse
    {
        $request->validate([
            'nombre_puesto' => 'required|string|max:255',
            'descripcion_puesto' => 'nullable|string',
            'departamento_id' => 'required|exists:departamentos,idDepartamento',
        ]);

        $puesto->update([
            'nombre_puesto' => $request->nombre_puesto,
            'descripcion_puesto' => $request->descripcion_puesto,
            'departamento_id' => $request->departamento_id,
        ]);

        return redirect()->route('puestos.index')->with('success', 'Puesto actualizado exitosamente.');
    }

    public function destroy(Puesto $puesto): RedirectResponse
    {
        try {
            $puesto->delete();
            return redirect()->route('puesto.index')
                ->with('success', 'Puesto eliminado exitosamente.');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('puesto.index')
                    ->with('error', 'No se puede eliminar el puesto porque está relacionada con otros registros.');
            }
        }
    }
}