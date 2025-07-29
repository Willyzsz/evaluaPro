<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $curso_id
 * @property integer $tema_id
 * @property integer $examen_id
 * @property integer $puesto_id
 * @property integer $departamento_id
 * @property integer $idReticula
 * @property Curso $curso
 * @property Examene $examene
 * @property Departamento $departamento
 * @property Tema $tema
 * @property Puesto $puesto
 */
class Reticula extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'reticulas';
    public $timestamps = false;


    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idReticula';

    /**
     * @var array
     */
    protected $fillable = ['puesto_id', 'departamento_id', 'nombre_reticula'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function puesto()
    {
        return $this->belongsTo('App\Models\Puesto', 'puesto_id', 'idPuesto');
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
    public function reticulasCursos()
    {
        return $this->hasMany('App\Models\ReticulasCurso', 'reticula_id', 'idReticula');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reticulasExamenes()
    {
        return $this->hasMany('App\Models\ReticulasExamene', 'reticula_id', 'idReticula');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reticulasTemas()
    {
        return $this->hasMany('App\Models\ReticulasTema', 'reticula_id', 'idReticula');
    }
}
