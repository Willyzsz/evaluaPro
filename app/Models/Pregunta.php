<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $examen_id
 * @property integer $idPregunta
 * @property string $texto
 * @property string $tipo
 * @property mixed $opciones
 * @property string $respuesta_correcta
 * @property Examene $examene
 */
class Pregunta extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idPregunta';
    public $timestamps = false;

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'idPregunta';
    }

    /**
     * @var array
     */
    protected $fillable = ['examen_id', 'texto', 'tipo', 'opciones', 'respuesta_correcta', 'imagen', 'puntos'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function examen()
    {
        return $this->belongsTo('App\Models\Examen', 'examen_id', 'idExamen');
    }
}
