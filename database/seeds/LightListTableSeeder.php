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
                'edition'       => '5',
                'year'          => '2017',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA'
            ]
        ]);
    }
}
