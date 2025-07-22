<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $idCurso
 * @property string $nombre_curso
 * @property string $descripcion_curso
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property ExamenesRealizado[] $examenesRealizados
 * @property Tema[] $temas
 */
class Curso extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idCurso';
    public $timestamps = false;


    /**
     * @var array
     */
    protected $fillable = ['nombre_curso', 'descripcion_curso', 'fecha_inicio', 'fecha_fin'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examenesRealizados()
    {
        return $this->hasMany('App\Models\ExamenesRealizado', 'curso_id', 'idCurso');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function temas()
    {
        return $this->hasMany('App\Models\Tema', 'curso_id', 'idCurso');
    }
}
