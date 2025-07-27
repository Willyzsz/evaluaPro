<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $departamento_id
 * @property integer $idPuesto
 * @property string $nombre_puesto
 * @property string $descripcion_puesto
 * @property ExamenesPuesto[] $examenesPuestos
 * @property Departamento $departamento
 * @property Reticula[] $reticulas
 * @property Tema[] $temas
 */
class puestosTest extends Model
{
  /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'puestos';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idPuesto';

    /**
     * @var array
     */
    protected $fillable = ['departamento_id', 'nombre_puesto', 'descripcion_puesto'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examenesPuestos()
    {
        return $this->hasMany('App\Models\ExamenesPuesto', 'puesto_id', 'idPuesto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departamento()
    {
        return $this->belongsTo('App\Models\Departamento', 'departamento_id', 'idDepartamento');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reticulas()
    {
        return $this->hasMany('App\Models\Reticula', 'puesto_id', 'idPuesto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function temas()
    {
        return $this->hasMany('App\Models\Tema', 'puesto_id', 'idPuesto');
    }
}
