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
class Preguntas extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idPregunta';

    /**
     * @var array
     */
    protected $fillable = ['examen_id', 'texto', 'tipo', 'opciones', 'respuesta_correcta'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function examene()
    {
        return $this->belongsTo('App\Models\Examene', 'examen_id', 'idExamen');
    }
}
