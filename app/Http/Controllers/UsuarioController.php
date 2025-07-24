<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'usuario' => 'required|string',
            'contrasena' => 'required|string'
        ]);
        
        $usuario = Usuario::where('usuario', $credentials['usuario'])->first();
        
        if (!$usuario || !Hash::check($credentials['contrasena'], $usuario->contrasena)) {
            return response()->json(['error' => 'Credenciales incorrectas'], 401);
        }
        
        // Crear sesión (si usas sesiones)
        Auth::login($usuario);
        
        // O devolver token (si usas API)
        // return response()->json([
        //     'usuario' => $usuario,
        //     'redirect' => $this->getRedirectByRole($usuario->rol_usuario)
        // ]);
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
    
    private function getRedirectByRole($role)
    {
        switch ($role) {
            case 'admin':
                return '/admin/dashboard';
            case 'capacitador':
                return '/capacitador/dashboard';
            default:
                return '/empleado/dashboard';
        }
    }
}
