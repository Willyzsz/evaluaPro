<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $examen_id
 * @property integer $reticula_id
 * @property integer $idReticulaExamen
 * @property Examene $examene
 * @property Reticula $reticula
 */
class ReticulaExamen extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'reticulas_examenes';
    public $timestamps = false;


    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idReticulaExamen';

    /**
     * @var array
     */
    protected $fillable = ['examen_id', 'reticula_id'];

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
    public function reticula()
    {
        return $this->belongsTo('App\Models\Reticula', 'reticula_id', 'idReticula');
    }
}
