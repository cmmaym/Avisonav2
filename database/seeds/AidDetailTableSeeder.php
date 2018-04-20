<?php

use Illuminate\Database\Seeder;

class AidDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aid_detail')->insert([
            [
                'description'      => 'Español',
                'observation'      => 'Español',
                'created_at'       => new \DateTime('now'),
                'updated_at'       => new \DateTime('now'),
                'aid_id'           => 1,
                'coordinate_id'    => 1,
                'light_type_id'    => 1,
                'color_type_id'    => 1,
                'novelty_type_id'  => 3,
                'language_id'      => 1 
            ],
            [
                'description'      => 'Ingles',
                'observation'      => 'Ingles',
                'created_at'       => new \DateTime('now'),
                'updated_at'       => new \DateTime('now'),
                'aid_id'           => 1,
                'coordinate_id'    => 1,
                'light_type_id'    => 2,
                'color_type_id'    => 2,
                'novelty_type_id'  => 4,
                'language_id'      => 2
            ],
            [
                'description'      => 'Español',
                'observation'      => 'Español',
                'created_at'       => new \DateTime('now'),
                'updated_at'       => new \DateTime('now'),
                'aid_id'           => 2,
                'coordinate_id'    => 2,
                'light_type_id'    => 3,
                'color_type_id'    => 3,
                'novelty_type_id'  => 5,
                'language_id'      => 1 
            ],
            [
                'description'      => 'Ingles',
                'observation'      => 'Ingles',
                'created_at'       => new \DateTime('now'),
                'updated_at'       => new \DateTime('now'),
                'aid_id'           => 2,
                'coordinate_id'    => 2,
                'light_type_id'    => 4,
                'color_type_id'    => 4,
                'novelty_type_id'  => 5,
                'language_id'      => 2
            ],
        ]);
    }
}
