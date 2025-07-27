<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $idUsuario
 * @property string $usuario
 * @property string $password
 * @property string $rol_usuario
 * @property integer $puesto_usuario
 * @property ExamenesRealizado[] $examenesRealizados
 * @property ExamenesRealizado[] $examenesRealizados
 */
class UsuarioTest extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'usuarios';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idUsuario';

    /**
     * @var array
     */
    protected $fillable = ['usuario', 'password', 'rol_usuario', 'puesto_usuario'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examenesRealizados()
    {
        return $this->hasMany('App\Models\ExamenesRealizado', null, 'idUsuario');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examenesRealizados()
    {
        return $this->hasMany('App\Models\ExamenesRealizado', 'usuario_calificador', 'idUsuario');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examenesRealizados()
    {
        return $this->hasMany('App\Models\ExamenesRealizado', 'usuario_calificador', 'idUsuario');
    }
}
