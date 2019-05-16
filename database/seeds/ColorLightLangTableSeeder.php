<?php

use Illuminate\Database\Seeder;

class ColorLightLangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('color_light_lang')->insert([
            [
                'color'             => 'Blanco',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'color_light_id'     => 1
            ],
            [
                'color'             => 'White',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'color_light_id'     => 1
            ],
            [
                'color'             => 'Rojo',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'color_light_id'     => 2
            ],
            [
                'color'             => 'Red',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'color_light_id'     => 2
            ],
            [
                'color'             => 'Verde',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'color_light_id'     => 3
            ],
            [
                'color'             => 'Green',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'color_light_id'     => 3
            ],
            [
                'color'             => 'Azul',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'color_light_id'     => 4
            ],
            [
                'color'             => 'Blue',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'color_type_id'     => 4
            ],
            [
                'color'             => 'Violeta',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'color_light_id'     => 5
            ],
            [
                'color'             => 'Violet',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'color_type_id'     => 5
            ],
            [
                'color'             => 'Amarillo',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'color_light_id'     => 6
            ],
            [
                'color'             => 'Yellow',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'color_type_id'     => 6
            ],
            [
                'color'             => 'Naranja',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'color_light_id'     => 7
            ],
            [
                'color'             => 'Orange',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'color_type_id'     => 7
            ],
            [
                'color'             => 'Ámbar',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'color_light_id'     => 8
            ],
            [
                'color'             => 'Amber',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'color_type_id'     => 8
            ]
        ]);
    }
}
