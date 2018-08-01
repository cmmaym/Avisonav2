<?php

use Illuminate\Database\Seeder;

class NoticeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notice')->insert([
            [
                'number'                => '001',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'year'                  => '2018',
                'state'                 => 'A',
                'file_info'             => null,
                'user'                  => 'JMARDZ',
                'entity_id'             => 1,
                'character_type_id'     => 1,
                'novelty_type_id'       => 1,
                'parent_id'             => null,
                'zone_id'               => 1,
                'catalog_ocean_coast_id'=> 1,
                'light_list_id'         => 1
            ],
            [
                'number'                => '002',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'year'                  => '2018',
                'state'                 => 'A',
                'file_info'             => null,
                'user'                  => 'JMARDZ',
                'entity_id'             => 2,
                'character_type_id'     => 1,
                'novelty_type_id'       => 2,
                'parent_id'             => null,
                'zone_id'               => 2,
                'catalog_ocean_coast_id'=> 2,
                'light_list_id'         => 2
            ],
            [
                'number'                => '003',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'year'                  => '2018',
                'state'                 => 'A',
                'file_info'             => null,
                'user'                  => 'JMARDZ',
                'entity_id'             => 3,
                'character_type_id'     => 2,
                'novelty_type_id'       => 3,
                'parent_id'             => null,
                'zone_id'               => 1,
                'catalog_ocean_coast_id'=> 3,
                'light_list_id'         => 3
            ],
            [
                'number'                => '004',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'year'                  => '2018',
                'state'                 => 'A',
                'file_info'             => null,
                'user'                  => 'JMARDZ',
                'entity_id'             => 4,
                'character_type_id'     => 2,
                'novelty_type_id'       => 4,
                'parent_id'             => null,
                'zone_id'               => 2,
                'catalog_ocean_coast_id'=> 4,
                'light_list_id'         => 1
            ],
        ]);
    }
}
