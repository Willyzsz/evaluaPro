<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $tema_id
 * @property integer $idExamen
 * @property string $nombre_examen
 * @property integer $duracion_examen
 * @property string $descripcion_examen
 * @property Tema $tema
 * @property ExamenesPuesto[] $examenesPuestos
 * @property ExamenesRealizado[] $examenesRealizados
 * @property ExamenesTema[] $examenesTemas
 * @property Pregunta[] $preguntas
 * @property Reticula[] $reticulas
 */
class Examen extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'examenes';
    public $timestamps = false;


    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idExamen';

    /**
     * @var array
     */
    protected $fillable = ['tema_id', 'nombre_examen', 'duracion_examen', 'descripcion_examen'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tema()
    {
        return $this->belongsTo('App\Models\Tema', 'tema_id', 'idTema');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examenesPuestos()
    {
        return $this->hasMany('App\Models\ExamenesPuesto', 'examen_id', 'idExamen');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examenesRealizados()
    {
        return $this->hasMany('App\Models\ExamenesRealizado', 'examen_id', 'idExamen');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examenesTemas()
    {
        return $this->hasMany('App\Models\ExamenesTema', 'examen_id', 'idExamen');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function preguntas()
    {
        return $this->hasMany('App\Models\Pregunta', 'examen_id', 'idExamen');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reticulas()
    {
        return $this->hasMany('App\Models\Reticula', 'examen_id', 'idExamen');
    }
}
