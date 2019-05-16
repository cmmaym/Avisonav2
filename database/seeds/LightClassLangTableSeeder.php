<?php

use Illuminate\Database\Seeder;

class LightClassLangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('light_class_lang')->insert([
            [
                'class'             => 'Fija',
                'description'       => 'Luz Fija',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'light_class_id'     => 1
            ],
            [
                'class'             => 'Fixed',
                'description'       => 'Fixed',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'light_class_id'     => 1
            ],
            [
                'class'             => 'De ocultación',
                'description'       => 'Duración total de la luz mayor que la oscuridad.',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'light_class_id'     => 2
            ],
            [
                'class'             => 'Occulting',
                'description'       => 'Total duration of light longer than total duration of darkness.',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'light_class_id'     => 2
            ],
            [
                'class'             => 'Isofase',
                'description'       => 'Igual duración y oscuridad',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'light_class_id'     => 3
            ],
            [
                'class'             => 'Isophase',
                'description'       => 'Duration of light and darkness equal',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'light_class_id'     => 3
            ],
            [
                'class'             => 'Destellos simples',
                'description'       => 'Duración total de la luz menor que la de la oscuridad',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'light_class_id'     => 4
            ],
            [
                'class'             => 'Single-flashing',
                'description'       => 'Total duration of light shorter than total duration of darkness',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'light_class_id'     => 4
            ],
            [
                'class'             => 'Centellante continuo',
                'description'       => 'Intervalos de repetición de 50 a 79 destellos por minuto generalmente entre 50 o 60',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'light_class_id'     => 5
            ],
            [
                'class'             => 'Continuos quik',
                'description'       => 'Repetition rate of 50 to 79 usually either 50 or 60 - flashes per minute',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'light_class_id'     => 5
            ],
            [
                'class'             => 'Centellos interrumpidos',
                'description'       => 'Luz centellante interrumpida',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'light_class_id'     => 6
            ],
            [
                'class'             => 'Interrupted quick',
                'description'       => 'Light interrupted quick',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'light_class_id'     => 6
            ],
            [
                'class'             => 'Centellante muy rápido continuo',
                'description'       => 'Centellante muy rapido (intervalo de repetición de 80 a 159 centellos por minuto, generalmente de 100 a 120)',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'light_class_id'     => 7
            ],
            [
                'class'             => 'Continuos very quick',
                'description'       => 'Repetition rate of 80 to 159 -  Usually either 100 or 120 - flashes per min',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'light_class_id'     => 7
            ],
            [
                'class'             => 'Centellante muy rapido interrumpido',
                'description'       => 'Luz centellante interrumpida rápida',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'light_class_id'     => 8
            ],
            [
                'class'             => 'Interrupted very quick',
                'description'       => 'Light interrupted very quick',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'light_class_id'     => 8
            ],
            [
                'class'             => 'Centellante ultrarápido continuo',
                'description'       => 'Luz centellante ultrarápida(intervalo de repetición de 160 o más destellos por minuto, generalmente de 240 a 300)',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'light_class_id'     => 9
            ],
            [
                'class'             => 'Interrupted ultra quick',
                'description'       => 'Ultra-fast dlashing light (repeat interval of 160 or more flashes per minute, generally 240 to 300)',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'light_class_id'     => 9
            ],
            [
                'class'             => 'Centellante ultrarápido interrumpido',
                'description'       => 'Centellante ultrarápido interrumpido',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'light_class_id'     => 10
            ],
            [
                'class'             => 'Interrupted ultra quick',
                'description'       => 'Interrupted ultra quick',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'light_class_id'     => 10
            ],
            [
                'class'             => 'Con señal morse',
                'description'       => 'Luz de señales morse',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'light_class_id'     => 11
            ],
            [
                'class'             => 'Morse code',
                'description'       => 'Light Morse code',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'light_class_id'     => 11
            ],
            [
                'class'             => 'Fija y destellante',
                'description'       => 'Luz fija y destello',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'light_class_id'     => 12
            ],
            [
                'class'             => 'Fixed and flashing',
                'description'       => 'Light fixed and flashing',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'light_class_id'     => 12
            ],
            [
                'class'             => 'Alternativa',
                'description'       => 'Luz alternada',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'light_class_id'     => 13
            ],
            [
                'class'             => 'Alternating',
                'description'       => 'Light alternating',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'light_class_id'     => 13
            ]
        ]);
    }
}
