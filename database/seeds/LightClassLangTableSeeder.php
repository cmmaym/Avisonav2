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
                'language_id'       => 1,
                'light_class_id'     => 1
            ],
            [
                'class'             => 'Fixed',
                'description'       => 'Fixed Light',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 2,
                'light_class_id'     => 1
            ],
            [
                'class'             => 'De ocultacion',
                'description'       => 'Duracion total de la luz mayor que la oscuridad.',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 1,
                'light_class_id'     => 2
            ],
            [
                'class'             => 'Occulting',
                'description'       => 'Total duration of light longer than total duration of darkness.',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 2,
                'light_class_id'     => 2
            ],
            [
                'class'             => 'Grupo de ocultaciones',
                'description'       => 'Luz de grupos de ocultaciones(mostrando 2 ocultaciones).',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 1,
                'light_class_id'     => 3
            ],
            [
                'class'             => 'Group-occulting',
                'description'       => 'Group occulting',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 2,
                'light_class_id'     => 3
            ]
        ]);
    }
}
