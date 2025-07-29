<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $curso_id
 * @property integer $reticula_id
 * @property integer $idReticulaCurso
 * @property Curso $curso
 * @property Reticula $reticula
 */
class ReticulaCurso extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'reticulas_cursos';
    public $timestamps = false;


    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idReticulaCurso';

    /**
     * @var array
     */
    protected $fillable = ['curso_id', 'reticula_id'];

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
    public function reticula()
    {
        return $this->belongsTo('App\Models\Reticula', 'reticula_id', 'idReticula');
    }
}
