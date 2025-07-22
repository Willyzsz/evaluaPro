<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $examen_id
 * @property integer $tema_id
 * @property integer $idExamenTema
 * @property Examene $examene
 * @property Tema $tema
 */
class ExamenTema extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'examenes_temas';
    public $timestamps = false;


    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idExamenTema';

    /**
     * @var array
     */
    protected $fillable = ['examen_id', 'tema_id'];

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
    public function tema()
    {
        return $this->belongsTo('App\Models\Tema', 'tema_id', 'idTema');
    }
}
