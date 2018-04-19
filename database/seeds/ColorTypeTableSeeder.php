<?php

use Illuminate\Database\Seeder;

class ColorTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('color_type')->insert([
            [
                'color'         => 'Blanco',
                'alias'         => 'W',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 1,
                'parent_id'     => null
            ],
            [
                'color'         => 'White',
                'alias'         => 'W',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 2,
                'parent_id'     => 1
            ],
            [
                'color'         => 'Rojo',
                'alias'         => 'R',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 1,
                'parent_id'     => null
            ],
            [
                'color'         => 'Red',
                'alias'         => 'R',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 2,
                'parent_id'     => 3
            ],
            [
                'color'         => 'Verde',
                'alias'         => 'G',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 1,
                'parent_id'     => null
            ],
            [
                'color'         => 'Green',
                'alias'         => 'G',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 2,
                'parent_id'     => 5
            ]
        ]);
    }
}
