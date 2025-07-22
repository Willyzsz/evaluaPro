<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $usuario_id
 * @property integer $examen_id
 * @property integer $curso_id
 * @property integer $idExamenRealizado
 * @property float $calificacion
 * @property string $fechaExamen_realizado
 * @property string $archivo_evidencia
 * @property Usuario $usuario
 * @property Curso $curso
 * @property Examene $examene
 */
class ExamenRealizado extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'examenes_realizados';
    public $timestamps = false;


    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idExamenRealizado';

    /**
     * @var array
     */
    protected $fillable = ['usuario_id', 'examen_id', 'curso_id', 'calificacion', 'fechaExamen_realizado', 'archivo_evidencia'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario', 'usuario_id', 'idUsuario');
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
    public function examene()
    {
        return $this->belongsTo('App\Models\Examene', 'examen_id', 'idExamen');
    }
}
