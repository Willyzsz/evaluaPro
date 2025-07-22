<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $examen_id
 * @property integer $puesto_id
 * @property integer $idExamenPuesto
 * @property Examene $examene
 * @property Puesto $puesto
 */
class ExamenPuesto extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'examenes_puestos';
    public $timestamps = false;


    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idExamenPuesto';

    /**
     * @var array
     */
    protected $fillable = ['examen_id', 'puesto_id'];

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
    public function puesto()
    {
        return $this->belongsTo('App\Models\Puesto', 'puesto_id', 'idPuesto');
    }
}
