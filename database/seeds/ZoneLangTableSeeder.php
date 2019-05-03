<?php

use Illuminate\Database\Seeder;

class ZoneLangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('zone_lang')->insert([
            [
                'name'          => 'Mar Caribe Colombiano',
                'alias'         => 'MCC',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 1,
                'zone_id'       => 1
            ],
            [
                'name'          => 'Colombian Caribbean Sea',
                'alias'         => 'CCS',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 2,
                'zone_id'     => 1
            ],
            [
                'name'          => 'Océano Pacífico Colombiano',
                'alias'         => 'OPC',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 1,
                'zone_id'       => 2
            ],
            [
                'name'          => 'Colombian Pacific Ocean ',
                'alias'         => 'CPO',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 2,
                'zone_id'       => 2
            ],
            [
                'name'          => 'Aguas Maritimas Jurisdiccionales Colombianas',
                'alias'         => 'AMJC',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 1,
                'zone_id'       => 3
            ],
            [
                'name'          => 'Colombian Jurisdictional Maritime Waters',
                'alias'         => 'CJMW',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 2,
                'zone_id'       => 3
            ],
            [
                'name'          => 'General',
                'alias'         => 'G',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 1,
                'zone_id'       => 4
            ],
            [
                'name'          => 'General',
                'alias'         => 'G',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 2,
                'zone_id'       => 4
            ]
        ]);
    }
    
}
