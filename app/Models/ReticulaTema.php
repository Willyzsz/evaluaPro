<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $tema_id
 * @property integer $reticula_id
 * @property integer $idReticulaTema
 * @property Tema $tema
 * @property Reticula $reticula
 */
class ReticulaTema extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'reticulas_temas';
    public $timestamps = false;


    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idReticulaTema';

    /**
     * @var array
     */
    protected $fillable = ['tema_id', 'reticula_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tema()
    {
        return $this->belongsTo('App\Models\Tema', 'tema_id', 'idTema');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reticula()
    {
        return $this->belongsTo('App\Models\Reticula', 'reticula_id', 'idReticula');
    }
}
