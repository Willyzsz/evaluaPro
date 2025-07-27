<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property integer $idUsuario
 * @property string $usuario
 * @property string $password
 * @property string $rol_usuario
 * @property integer $puesto_usuario
 * @property ExamenesRealizado[] $examenesRealizados
 */
class Usuario extends Authenticatable
{
    protected $table = 'usuarios';
    protected $primaryKey = 'idUsuario';
    protected $fillable = ['usuario','password', 'rol_usuario', 'puesto_usuario'];
    protected $hidden = ['password', 'remember_token'];
    
    public $timestamps = false;
    public function getAuthPassword() {
        return $this->password;
    }
    public function examenesRealizados()
    {
        return $this->hasMany('App\Models\ExamenesRealizado', 'usuario_id', 'idUsuario');
    }
    public function getAuthIdentifierName()
    {
        return 'usuario';
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examenesRealizadosCalificador()
    {
        return $this->hasMany('App\Models\ExamenesRealizado', 'usuario_calificador', 'idUsuario');
    }
}
