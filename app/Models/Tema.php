<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $curso_id
 * @property integer $puesto_id
 * @property integer $idTema
 * @property string $nombre_tema
 * @property string $descripcion_tema
 * @property Examene[] $examenes
 * @property ExamenesTema[] $examenesTemas
 * @property Puesto $puesto
 * @property Curso $curso
 */
class Tema extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idTema';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['curso_id', 'puesto_id', 'nombre_tema', 'descripcion_tema', 'tema_url', 'curso_id', 'puesto_id', 'departamento_id'];
     
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'idTema';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examenes()
    {
        return $this->hasMany('App\Models\Examene', 'tema_id', 'idTema');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examenesTemas()
    {
        return $this->hasMany('App\Models\ExamenesTema', 'tema_id', 'idTema');
    }

        /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reticulas()
    {
        return $this->hasMany('App\Models\Reticula', 'examen_id', 'idExamen');
    }
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
    public function curso()
    {
        return $this->belongsTo('App\Models\Curso', 'curso_id', 'idCurso');
    }
        /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departamento()
    {
        return $this->belongsTo('App\Models\Departamento', 'departamento_id', 'idDepartamento');
    }
}
