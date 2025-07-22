<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $puesto_id
 * @property integer $idDepartamento
 * @property string $nombre_departamento
 * @property string $descripcion_departamento
 * @property Puesto $puesto
 * @property Direccione[] $direcciones
 */
class Departamento extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idDepartamento';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['puesto_id', 'nombre_departamento', 'descripcion_departamento'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function puesto()
    {
        return $this->belongsTo('App\Models\Puesto', 'puesto_id', 'idPuesto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function direcciones()
    {
        return $this->hasMany('App\Models\Direccione', 'departamento_id', 'idDepartamento');
    }
}
