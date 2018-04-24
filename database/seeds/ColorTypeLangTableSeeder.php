<?php

use Illuminate\Database\Seeder;

class ColorTypeLangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('color_type_lang')->insert([
            [
                'color'             => 'Blanco',
                'alias'             => 'W',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 1,
                'color_type_id'     => 1
            ],
            [
                'color'             => 'White',
                'alias'             => 'W',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 2,
                'color_type_id'     => 1
            ],
            [
                'color'             => 'Rojo',
                'alias'             => 'R',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 1,
                'color_type_id'     => 2
            ],
            [
                'color'             => 'Red',
                'alias'             => 'R',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 2,
                'color_type_id'     => 2
            ],
            [
                'color'             => 'Verde',
                'alias'             => 'G',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 1,
                'color_type_id'     => 3
            ],
            [
                'color'             => 'Green',
                'alias'             => 'G',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 2,
                'color_type_id'     => 3
            ]
        ]);
    }
}
