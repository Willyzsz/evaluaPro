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
    protected $fillable = ['curso_id', 'nombre_reticula', 'tema_id', 'examen_id', 'puesto_id', 'departamento_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function curso()
    {
        return $this->belongsTo('App\Models\Curso', 'curso_id', 'idCurso');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function examen()
    {
        return $this->belongsTo('App\Models\Examen', 'examen_id', 'idExamen');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departamento()
    {
        return $this->belongsTo('App\Models\Departamento', 'departamento_id', 'idDepartamento');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tema()
    {
        return $this->belongsTo('App\Models\Tema', 'tema_id', 'idTema');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function puesto()
    {
        return $this->belongsTo('App\Models\Puesto', 'puesto_id', 'idPuesto');
    }
}
