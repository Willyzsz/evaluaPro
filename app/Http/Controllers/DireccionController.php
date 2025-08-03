<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Direccion;
use Illuminate\Database\QueryException;


class DireccionController extends Controller
{

    public function index(Request $request): View
    {
        $search = $request->get('search');
        $direcciones = Direccion::query()
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nombre_direccion', 'LIKE', "%{$search}%");
            });
        })
        ->get();
    
        return view('admin.direcciones', compact('direcciones'));
    }

    public function create(): View
    {
        $direcciones = Direccion::all();
        return view('admin.direcciones.create', compact('direcciones'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre_direccion' => 'required|string|max:255',
            'descripcion_direccion' => 'nullable|string',
        ]);

        Direccion::create([
            'nombre_direccion' => $request->nombre_direccion,
            'descripcion_direccion' => $request->descripcion_direccion,
        ]);

        return redirect()->route('direcciones.index')->with('success', 'Direccion creado exitosamente.');
    }

    public function show(Direccion $direccion): View
    {
        
        return view('admin.direcciones.show', compact('direccion'));
    }

    public function edit(Direccion $direccion): View
    {
        return view('admin.direcciones.edit', compact('direccion'));
    }

    public function update(Request $request, Direccion $direccion): RedirectResponse
    {
        $request->validate([
            'nombre_direccion' => 'required|string|max:255',
            'descripcion_direccion' => 'nullable|string',
        ]);

        $direccion->update([
            'nombre_direccion' => $request->nombre_direccion,
            'descripcion_direccion' => $request->descripcion_direccion,
        ]);

        return redirect()->route('direcciones.index')->with('success', 'Direccion actualizada exitosamente.');
    }

    public function destroy(Direccion $direccion): RedirectResponse
    {
        try {
            $direccion->delete();
            return redirect()->route('direcciones.index')
                ->with('success', 'Dirección eliminada exitosamente.');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('direcciones.index')
                    ->with('error', 'No se puede eliminar la dirección porque está relacionada con otros registros.');
            }
        }
    }
}