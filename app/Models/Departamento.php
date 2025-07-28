<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $direcciones_id
 * @property integer $idDepartamento
 * @property string $nombre_departamento
 * @property string $descripcion_departamento
 * @property Direccione $direccione
 * @property Puesto[] $puestos
 * @property Reticula[] $reticulas
 */
class Departamento extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'departamentos';
    public $timestamps = false;


    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idDepartamento';

    /**
     * @var array
     */
    protected $fillable = ['direcciones_id', 'nombre_departamento', 'descripcion_departamento'];

        /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'idDepartamento';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function direccione()
    {
        return $this->belongsTo('App\Models\Direccione', 'direcciones_id', 'idDireccion');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examenesPuestos()
    {
        return $this->hasMany('App\Models\ExamenesPuesto', 'departamento_id', 'idDepartamento');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function puestos()
    {
        return $this->hasMany('App\Models\Puesto', 'departamento_id', 'idDepartamento');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reticulas()
    {
        return $this->hasMany('App\Models\Reticula', 'departamento_id', 'idDepartamento');
    }
        /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function temas()
    {
        return $this->hasMany('App\Models\Tema', 'departamento_id', 'idDepartamento');
    }
}
