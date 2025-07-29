<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Departamento;
use App\Models\Direccion;


class DepartamentoController extends Controller
{

    public function index(Request $request): View
    {
        $search = $request->get('search');
        $departamentos = Departamento::with('direccion')
        ->when($search, function($query) use ($search) {
          $query->where(function ($q) use ($search) {
            $q->where('nombre_departamento', 'LIKE', "%{$search}%")
            ->orWhereHas('direccion', function($departamentoQuery) use ($search) {
                $departamentoQuery->where('nombre_direccion', 'LIKE', "%{$search}%");
            });
          });
        })
        ->get();
        return view('admin.departamentos', compact('departamentos'));
    }

    public function create(): View
    {
        $direcciones = Direccion::all();
        return view('admin.departamentos.create', compact('direcciones'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre_departamento' => 'required|string|max:255',
            'descripcion_departamento' => 'required|string',
            'direcciones_id' => 'required|exists:direcciones,idDireccion',
        ]);

        Departamento::create([
            'nombre_departamento' => $request->nombre_departamento,
            'descripcion_departamento' => $request->descripcion_departamento,
            'direcciones_id' => $request->direcciones_id,
        ]);

        return redirect()->route('departamentos.index')->with('success', 'Departamento creado exitosamente.');
    }

    public function show(Departamento $departamento): View
    {
        $departamento->load('direccion');
        return view('admin.departamentos.show', compact('departamento'));
    }

    public function edit(Departamento $departamento): View
    {
        $direcciones = Direccion::all();
        return view('admin.departamentos.edit', compact('departamento', 'direcciones'));
    }

    public function update(Request $request, Departamento $departamento): RedirectResponse
    {
        $request->validate([
            'nombre_departamento' => 'required|string|max:255',
            'descripcion_departamento' => 'nullable|string',
            'direcciones_id' => 'required|exists:direcciones,idDireccion',
        ]);

        $departamento->update([
            'nombre_departamento' => $request->nombre_departamento,
            'descripcion_departamento' => $request->descripcion_departamento,
            'direcciones_id' => $request->direcciones_id,
        ]);

        return redirect()->route('departamentos.index')->with('success', 'Departamento actualizado exitosamente.');
    }

    public function destroy(Departamento $departamento): RedirectResponse
    {
        try {
            $departamento->delete();
            return redirect()->route('departamento.index')
                ->with('success', 'Puesto eliminado exitosamente.');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('departamento.index')
                    ->with('error', 'No se puede eliminar el departamento porque está relacionada con otros registros.');
            }
        }
    }
}