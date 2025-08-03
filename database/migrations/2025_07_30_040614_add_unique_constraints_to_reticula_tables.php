<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('reticulas_temas', function (Blueprint $table) {
            $table->unique(['reticula_id', 'tema_id'], 'uniq_reticula_tema');
        });
    
        Schema::table('reticulas_examenes', function (Blueprint $table) {
            $table->unique(['reticula_id', 'examen_id'], 'uniq_reticula_examen');
        });
    
        Schema::table('reticulas_cursos', function (Blueprint $table) {
            $table->unique(['reticula_id', 'curso_id'], 'uniq_reticula_curso');
        });
    }
    public function down()
    {
        Schema::table('reticulas_temas', function (Blueprint $table) {
            $table->dropUnique('uniq_reticula_tema');
        });
    
        Schema::table('reticulas_examenes', function (Blueprint $table) {
            $table->dropUnique('uniq_reticula_examen');
        });
    
        Schema::table('reticulas_cursos', function (Blueprint $table) {
            $table->dropUnique('uniq_reticula_curso');
        });
    }
};
