<?php

use Illuminate\Database\Seeder;

class ColorStructureLangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('color_structure_lang')->insert([
            [
                'name'             => 'Blanco',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 1,
                'color_structure_id'     => 1
            ],
            [
                'name'             => 'White',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 2,
                'color_structure_id'     => 1
            ],
            [
                'name'             => 'Rojo',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 1,
                'color_structure_id'     => 2
            ],
            [
                'name'             => 'Red',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 2,
                'color_structure_id'     => 2
            ],
            [
                'name'             => 'Verde',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 1,
                'color_structure_id'     => 3
            ],
            [
                'name'             => 'Green',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 2,
                'color_structure_id'     => 3
            ],
            [
                'name'             => 'Negro',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 1,
                'color_structure_id'     => 4
            ],
            [
                'name'             => 'Black',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 2,
                'color_structure_id'     => 4
            ]
        ]);
    }
}
