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
                'year'                  => '2018',
                'report_date'            => new \DateTime('now'),
                'reports_numbers'       => '60, 61',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'state'                 => 'A',
                'file_info'             => null,
                'user'                  => 'JMARDZ',
                'parent_id'             => null,
                'character_type_id'     => 1,
                'novelty_type_id'       => 1,
                'zone_id'               => 1,
                'catalog_ocean_coast_id'=> 1,
                'light_list_id'         => 1,
                'report_source_id'      => 1,
                'reporting_user_id'     => 1
            ],
            [
                'number'                => '002',
                'year'                  => '2018',
                'report_date'            => new \DateTime('now'),
                'reports_numbers'       => '62, 63',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'state'                 => 'A',
                'file_info'             => null,
                'user'                  => 'JMARDZ',
                'parent_id'             => null,
                'character_type_id'     => 2,
                'novelty_type_id'       => 2,
                'zone_id'               => 2,
                'catalog_ocean_coast_id'=> 2,
                'light_list_id'         => 2,
                'report_source_id'      => 2,
                'reporting_user_id'     => 2
            ],
            [
                'number'                => '003',
                'year'                  => '2018',
                'report_date'            => new \DateTime('now'),
                'reports_numbers'       => '64, 65, 66',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'state'                 => 'A',
                'file_info'             => null,
                'user'                  => 'JMARDZ',
                'parent_id'             => null,
                'character_type_id'     => 3,
                'novelty_type_id'       => 4,
                'zone_id'               => 1,
                'catalog_ocean_coast_id'=> 3,
                'light_list_id'         => 3,
                'report_source_id'      => 3,
                'reporting_user_id'     => 3
            ],
            [
                'number'                => '004',
                'year'                  => '2018',
                'report_date'            => new \DateTime('now'),
                'reports_numbers'       => '67, 68, 69',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'state'                 => 'A',
                'file_info'             => null,
                'user'                  => 'JMARDZ',
                'parent_id'             => null,
                'character_type_id'     => 2,
                'novelty_type_id'       => 3,
                'zone_id'               => 2,
                'catalog_ocean_coast_id'=> 4,
                'light_list_id'         => 4,
                'report_source_id'      => 4,
                'reporting_user_id'     => 4
            ],
        ]);
    }
}
