<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $idCurso
 * @property string $nombre_curso
 * @property string $descripcion_curso
 * @property string $curso_url
 * @property ExamenesRealizado[] $examenesRealizados
 * @property ReticulasCurso[] $reticulasCursos
 * @property Tema[] $temas
 */
class CursoTest extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'cursos';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idCurso';

    /**
     * @var array
     */
    protected $fillable = ['nombre_curso', 'descripcion_curso', 'curso_url'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examenesRealizados()
    {
        return $this->hasMany('App\Models\ExamenesRealizado', null, 'idCurso');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reticulasCursos()
    {
        return $this->hasMany('App\Models\ReticulasCurso', null, 'idCurso');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function temas()
    {
        return $this->hasMany('App\Models\Tema', null, 'idCurso');
    }
}
