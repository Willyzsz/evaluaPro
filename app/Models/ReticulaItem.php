<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $reticula_id
 * @property integer $idReticulaItem
 * @property string $tipo
 * @property integer $referencia_id
 * @property integer $orden
 * @property Reticula $reticula
 */
class ReticulaItem extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idReticulaItem';
    public $timestamps = false;


    /**
     * @var array
     */
    protected $fillable = ['reticula_id', 'tipo', 'referencia_id', 'orden'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reticula()
    {
        return $this->belongsTo('App\Models\Reticula', 'reticula_id', 'idReticula');
    }
}
