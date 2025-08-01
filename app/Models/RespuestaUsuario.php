<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $examen_realizado_id
 * @property integer $pregunta_id
 * @property string $respuesta
 * @property boolean $correcta
 * @property ExamenesRealizado $examenesRealizado
 * @property Pregunta $pregunta
 */
class RespuestaUsuario extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'respuestas_usuario';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['examen_realizado_id', 'pregunta_id', 'respuesta', 'correcta'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function examenRealizado()
    {
        return $this->belongsTo('App\Models\ExamenRealizado', 'examen_realizado_id', 'idExamenRealizado');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pregunta()
    {
        return $this->belongsTo('App\Models\Pregunta', 'pregunta_id', 'idPregunta');
    }
}
