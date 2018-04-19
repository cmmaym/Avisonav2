<?php

use Illuminate\Database\Seeder;

class LightTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('light_type')->insert([
            [
                'class'         => 'Fija',
                'alias'         => 'F',
                'description'   => 'Luz Fija',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 1,
                'parent_id'     => null
            ],
            [
                'class'         => 'Fixed',
                'alias'         => 'F',
                'description'   => 'Fixed Light',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 2,
                'parent_id'     => 1
            ],
            [
                'class'         => 'De ocultacion',
                'alias'         => 'Oc.',
                'description'   => 'Duracion total de la luz mayor que la oscuridad.',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 1,
                'parent_id'     => null
            ],
            [
                'class'         => 'Occulting',
                'alias'         => 'Oc.',
                'description'   => 'Total duration of light longer than total duration of darkness.',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 2,
                'parent_id'     => 3
            ],
            [
                'class'         => 'Grupo de ocultaciones',
                'alias'         => 'Oc. (2)',
                'description'   => 'Luz de grupos de ocultaciones(mostrando 2 ocultaciones).',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 1,
                'parent_id'     => null
            ],
            [
                'class'         => 'Group-occulting',
                'alias'         => 'Oc. (2)',
                'description'   => 'Group occulting',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 2,
                'parent_id'     => 5
            ]
        ]);
    }
}
