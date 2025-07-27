<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Puesto;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class GestionUsuarioController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->get('search');
        $fechaOrder = $request->get('fecha_order', 'desc');
        $estatusFilter = $request->get('estatus_filter', '');
        
        $usuarios = Usuario::with('puesto.departamento')
            ->where('rol_usuario', '!=', 'admin')
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
            ->when($estatusFilter !== '', function ($query) use ($estatusFilter) {
                $query->where('estatus', $estatusFilter);
            })
            ->when($fechaOrder, function ($query) use ($fechaOrder) {
                $query->orderBy('fecha_ingreso', $fechaOrder);
            })
            ->get();
            
        return view('admin.usuarios', compact('usuarios', 'fechaOrder', 'estatusFilter'));
    }
    public function create(): View
    {
        $puestos = Puesto::all();
        return view('admin.usuarios.create', compact('puestos'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'usuario' => 'required|string|max:50',
            'password' => 'required|string|min:6|confirmed',
            'rol_usuario' => 'required',
            'puesto_id' => 'required|exists:puestos,idPuesto',
            'fecha_ingreso' => 'nullable|date',
            'estatus' => 'nullable|integer|in:0,1',
        ]);

        Usuario::create([
            'usuario' => $request->usuario,
            'password' => Hash::make($request->password),
            'rol_usuario' => $request->rol_usuario,
            'puesto_usuario' => $request->puesto_id,
            'fecha_ingreso' => $request->fecha_ingreso ?: now()->format('Y-m-d'),
            'estatus' => $request->estatus ?: 1,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function show(Usuario $usuario): View
    {
        $usuario->load('puesto.departamento');
        return view('admin.usuarios.show', compact('usuario'));
    }

    public function edit(Usuario $usuario): View
    {
        $puestos = Puesto::all();
        return view('admin.usuarios.edit', compact('usuario', 'puestos'));
    }

    public function update(Request $request, Usuario $usuario): RedirectResponse
    {
        $request->validate([
            'usuario' => 'required|string|max:50',
            'password' => 'nullable|string|min:6|confirmed',
            'rol_usuario' => 'required',
            'puesto_id' => 'required|exists:puestos,idPuesto',
            'estatus' => 'nullable|integer|in:0,1',
            'fecha_ingreso' => 'nullable|date',
        ]);

        $updateData = [
            'usuario' => $request->usuario,
            'rol_usuario' => $request->rol_usuario,
            'puesto_usuario' => $request->puesto_id,
            'estatus'=> $request->estatus,
            'fecha_ingreso'=> $request->fecha_ingreso,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $usuario->update($updateData);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy(Usuario $usuario): RedirectResponse
    {
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}

