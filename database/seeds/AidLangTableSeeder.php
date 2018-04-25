<?php

use Illuminate\Database\Seeder;

class AidLangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aid_lang')->insert([
            [
                'description'      => 'Español',
                'observation'      => 'Español',
                'created_at'       => new \DateTime('now'),
                'updated_at'       => new \DateTime('now'),
                'aid_id'           => 1,
                'coordinate_id'    => 1,
                'language_id'      => 1,
            ],
            [
                'description'      => 'Ingles',
                'observation'      => 'Ingles',
                'created_at'       => new \DateTime('now'),
                'updated_at'       => new \DateTime('now'),
                'aid_id'           => 1,
                'coordinate_id'    => 1,
                'language_id'      => 2,
            ],
            [
                'description'      => 'Español',
                'observation'      => 'Español',
                'created_at'       => new \DateTime('now'),
                'updated_at'       => new \DateTime('now'),
                'aid_id'           => 2,
                'coordinate_id'    => 2,
                'language_id'      => 1,
            ],
            [
                'description'      => 'Ingles',
                'observation'      => 'Ingles',
                'created_at'       => new \DateTime('now'),
                'updated_at'       => new \DateTime('now'),
                'aid_id'           => 2,
                'coordinate_id'    => 2,
                'language_id'      => 2,
            ],
        ]);
    }
}
