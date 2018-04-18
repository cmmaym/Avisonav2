<?php

use Illuminate\Database\Seeder;

class ZoneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('zone')->insert([
            [
                'name'          => 'Mar Caribe Colombiano',
                'alias'         => 'MCC',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 1,
                'parent_id'     => null
            ],
            [
                'name'          => 'Colombian Caribbean Sea',
                'alias'         => 'CCS',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 2,
                'parent_id'     => 1
            ],
            [
                'name'          => 'Océano Pacífico Colombiano',
                'alias'         => 'OPC',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 1,
                'parent_id'     => null
            ],
            [
                'name'          => 'Colombian Pacific Ocean ',
                'alias'         => 'CPO',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 2,
                'parent_id'     => 3
            ]
        ]);
    }
    
}
