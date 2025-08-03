<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tema;
use App\Models\Examen;

class ExamenSeeder extends Seeder
{
    public function run(): void
    {
        // Create some sample temas
        $temas = [
            [
                'nombre_tema' => 'Seguridad Industrial',
                'descripcion_tema' => 'Normas y procedimientos de seguridad en el trabajo',
                'curso_id' => 1,
                'puesto_id' => 1,
            ],
            [
                'nombre_tema' => 'Equipos de Protección Personal',
                'descripcion_tema' => 'Uso correcto de EPP en diferentes áreas',
                'curso_id' => 1,
                'puesto_id' => 1,
            ],
            [
                'nombre_tema' => 'Protocolos de Emergencia',
                'descripcion_tema' => 'Procedimientos en caso de emergencias',
                'curso_id' => 1,
                'puesto_id' => 1,
            ],
        ];

        foreach ($temas as $tema) {
            Tema::create($tema);
        }

        // Create some sample examenes
        $examenes = [
            [
                'nombre_examen' => 'Examen de Seguridad Básica',
                'descripcion_examen' => 'Evaluación de conocimientos básicos en seguridad industrial',
                'duracion_examen' => 30,
                'tema_id' => 1,
            ],
            [
                'nombre_examen' => 'Examen de EPP',
                'descripcion_examen' => 'Evaluación sobre el uso correcto de equipos de protección personal',
                'duracion_examen' => 45,
                'tema_id' => 2,
            ],
            [
                'nombre_examen' => 'Examen de Protocolos de Emergencia',
                'descripcion_examen' => 'Evaluación de conocimientos sobre procedimientos de emergencia',
                'duracion_examen' => 60,
                'tema_id' => 3,
            ],
        ];

        foreach ($examenes as $examen) {
            Examen::create($examen);
        }
    }
} 