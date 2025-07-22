<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $idPuesto
 * @property string $nombre_puesto
 * @property string $descripcion_puesto
 * @property Departamento[] $departamentos
 * @property ExamenesPuesto[] $examenesPuestos
 * @property Tema[] $temas
 */
class Puesto extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idPuesto';
    public $timestamps = false;


    /**
     * @var array
     */
    protected $fillable = ['nombre_puesto', 'descripcion_puesto'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departamentos()
    {
        return $this->hasMany('App\Models\Departamento', 'puesto_id', 'idPuesto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examenesPuestos()
    {
        return $this->hasMany('App\Models\ExamenesPuesto', 'puesto_id', 'idPuesto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function temas()
    {
        return $this->hasMany('App\Models\Tema', 'puesto_id', 'idPuesto');
    }
}
