<?php

use Illuminate\Database\Seeder;

class LightTypeLangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('light_type_lang')->insert([
            [
                'class'             => 'Fija',
                'alias'             => 'F',
                'description'       => 'Luz Fija',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 1,
                'light_type_id'     => 1
            ],
            [
                'class'             => 'Fixed',
                'alias'             => 'F',
                'description'       => 'Fixed Light',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 2,
                'light_type_id'     => 1
            ],
            [
                'class'             => 'De ocultacion',
                'alias'             => 'Oc.',
                'description'       => 'Duracion total de la luz mayor que la oscuridad.',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 1,
                'light_type_id'     => 2
            ],
            [
                'class'             => 'Occulting',
                'alias'             => 'Oc.',
                'description'       => 'Total duration of light longer than total duration of darkness.',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 2,
                'light_type_id'     => 2
            ],
            [
                'class'             => 'Grupo de ocultaciones',
                'alias'             => 'Oc. (2)',
                'description'       => 'Luz de grupos de ocultaciones(mostrando 2 ocultaciones).',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 1,
                'light_type_id'     => 3
            ],
            [
                'class'             => 'Group-occulting',
                'alias'             => 'Oc. (2)',
                'description'       => 'Group occulting',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 2,
                'light_type_id'     => 3
            ]
        ]);
    }
}
