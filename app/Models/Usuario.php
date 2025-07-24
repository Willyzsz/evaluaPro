<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property integer $idUsuario
 * @property string $usuario
 * @property string $contrasena
 * @property string $rol_usuario
 * @property integer $puesto_usuario
 * @property ExamenesRealizado[] $examenesRealizados
 */
class Usuario extends Authenticatable
{
    protected $table = 'usuarios';
    protected $primaryKey = 'idUsuario';
    protected $fillable = ['usuario','contrasena', 'rol_usuario', 'puesto_usuario'];
    protected $hidden = ['contrasena', 'remember_token'];
    
    public $timestamps = false;
    public function getAuthPassword() {
        return $this->contrasena;
    }
    public function examenesRealizados()
    {
        return $this->hasMany('App\Models\ExamenesRealizado', 'usuario_id', 'idUsuario');
    }
    public function getAuthIdentifierName()
    {
        return 'usuario';
    }
}
