<?php

use Illuminate\Database\Seeder;

class LightListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('light_list')->insert([
            [
                'edition'       => '1',
                'year'          => '2013',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'edition'       => '2',
                'year'          => '2014',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'edition'       => '3',
                'year'          => '2015',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'edition'       => '4',
                'year'          => '2016',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ]
        ]);
    }
}
