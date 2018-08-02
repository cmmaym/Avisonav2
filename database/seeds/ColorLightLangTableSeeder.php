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
                'language_id'       => 1,
                'color_light_id'     => 1
            ],
            [
                'color'             => 'White',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 2,
                'color_light_id'     => 1
            ],
            [
                'color'             => 'Rojo',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 1,
                'color_light_id'     => 2
            ],
            [
                'color'             => 'Red',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 2,
                'color_light_id'     => 2
            ],
            [
                'color'             => 'Verde',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 1,
                'color_light_id'     => 3
            ],
            [
                'color'             => 'Green',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 2,
                'color_light_id'     => 3
            ],
            [
                'color'             => 'Negro',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 1,
                'color_light_id'     => 4
            ],
            [
                'color'             => 'Black',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 2,
                'color_type_id'     => 4
            ]
        ]);
    }
}
