<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        Usuario::create([
            'usuario' => 'admin',
            'password' => Hash::make('admin123'),
            'rol_usuario' => 'admin',
            'puesto_usuario' => 1,
        ]);
        Usuario::create([
            'usuario' => 'capacitador',
            'password' => Hash::make('capacitador123'),
            'rol_usuario' => 'capacitador',
            'puesto_usuario' => 2,
        ]);
        Usuario::create([
            'usuario' => 'usuario',
            'password' => Hash::make('usuario123'),
            'rol_usuario' => 'usuario',
            'puesto_usuario' => 3,
        ]);
    }
}