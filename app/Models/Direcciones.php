<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $departamento_id
 * @property integer $idDireccion
 * @property string $nombre_direccion
 * @property Departamento $departamento
 */
class Direcciones extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idDireccion';
    public $timestamps = false;


    /**
     * @var array
     */
    protected $fillable = ['departamento_id', 'nombre_direccion'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departamento()
    {
        return $this->belongsTo('App\Models\Departamento', 'departamento_id', 'idDepartamento');
    }
}
