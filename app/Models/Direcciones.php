<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $idDireccion
 * @property string $nombre_direccion
 * @property Departamento[] $departamentos
 */
class Direccion extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'direcciones';
    public $timestamps = false;


    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idDireccion';

    /**
     * @var array
     */
    protected $fillable = ['nombre_direccion'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departamentos()
    {
        return $this->hasMany('App\Models\Departamento', 'direcciones_id', 'idDireccion');
    }
}
