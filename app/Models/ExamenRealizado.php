<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $usuario_id
 * @property integer $examen_id
 * @property integer $curso_id
 * @property integer $usuario_calificador
 * @property integer $idExamenRealizado
 * @property float $calificacion
 * @property string $fechaExamen_realizado
 * @property string $archivo_evidencia
 * @property integer $numero_intento
 * @property Usuario $usuario
 * @property Curso $curso
 * @property Examene $examene
 * @property Usuario $usuario
 * @property RespuestasUsuario[] $respuestasUsuarios
 */
class ExamenRealizado extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'examenes_realizados';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idExamenRealizado';

    /**
     * @var array
     */
    protected $fillable = ['usuario_id', 'examen_id', 'curso_id', 'usuario_calificador', 'calificacion', 'fechaExamen_realizado', 'archivo_evidencia', 'numero_intento'];

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuarioCalificador()
    {
        return $this->belongsTo('App\Models\Usuario', 'usuario_calificador', 'idUsuario');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function respuestasUsuarios()
    {
        return $this->hasMany('App\Models\RespuestasUsuario', 'examen_realizado_id', 'idExamenRealizado');
    }
}
