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
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'color_structure_id'     => 1
            ],
            [
                'name'             => 'White',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'color_structure_id'     => 1
            ],
            [
                'name'             => 'Rojo',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'color_structure_id'     => 2
            ],
            [
                'name'             => 'Red',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'color_structure_id'     => 2
            ],
            [
                'name'             => 'Verde',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'color_structure_id'     => 3
            ],
            [
                'name'             => 'Green',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'color_structure_id'     => 3
            ],
            [
                'name'             => 'Negro',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'color_structure_id'     => 4
            ],
            [
                'name'             => 'Black',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'color_structure_id'     => 4
            ],
            [
                'name'             => 'Amarillo',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'color_structure_id'     => 5
            ],
            [
                'name'             => 'Yellow',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'color_structure_id'     => 5
            ],
            [
                'name'             => 'Negro sobre Amarillo',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'color_structure_id'     => 6
            ],
            [
                'name'             => 'Black on Yellow',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'color_structure_id'     => 6
            ],
            [
                'name'             => 'Rojo con una banda ancha horizontal verde',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'color_structure_id'     => 7
            ],
            [
                'name'             => 'Red with a wide horizontal green band',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'color_structure_id'     => 7
            ],
            [
                'name'             => 'Verde con una banda ancha horizontal roja',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'color_structure_id'     => 8
            ],
            [
                'name'             => 'Green with a wide horizontal red band',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'color_structure_id'     => 8
            ],
            [
                'name'             => 'Negro con una banda ancha horizontal amarilla',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'color_structure_id'     => 9
            ],
            [
                'name'             => 'Black with a wide horizontal yellow band',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'color_structure_id'     => 9
            ],
            [
                'name'             => 'Amarillo sobre negro',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'color_structure_id'     => 10
            ],
            [
                'name'             => 'Yellow on black',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'color_structure_id'     => 10
            ],
            [
                'name'             => 'Amarillo con una banda ancha horizontal negra',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'color_structure_id'     => 11
            ],
            [
                'name'             => 'Yellow with a wide horizontal black band',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'color_structure_id'     => 11
            ],
            [
                'name'             => 'Negro con una o varias bandas anchas horizontales rojas',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'color_structure_id'     => 12
            ],
            [
                'name'             => 'Black with one or more wide red horizontal stripes',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'color_structure_id'     => 12
            ],
            [
                'name'             => 'Franjas verticales rojas y blancas',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'color_structure_id'     => 13
            ],
            [
                'name'             => 'Red and white vertical stripes',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'color_structure_id'     => 13
            ],
            [
                'name'             => 'Naranja',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'color_structure_id'     => 14
            ],
            [
                'name'             => 'Orange',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'color_structure_id'     => 14
            ],
            [
                'name'             => 'Ámbar',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 1,
                'color_structure_id'     => 15
            ],
            [
                'name'             => 'Amber',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'       => 2,
                'color_structure_id'     => 15
            ]
        ]);
    }
}
