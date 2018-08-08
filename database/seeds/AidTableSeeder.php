<?php

use Illuminate\Database\Seeder;

class AidTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aid')->insert([
            [
                'racon'                              => 'no',
                'ais'                                => '11111',
                'height'                             => '3 m',
                'float_diameter'                     => '2.4 m',
                'elevation_nmm'                      => '4.22 m',
                'scope'                              => '4.17 m',
                'sector_angle'                       => '360°',
                'period'                             => '3 s',
                'features'                           => '0.5 s, OC 2.5 s',
                'created_at'                         => new \DateTime('now'),
                'updated_at'                         => new \DateTime('now'),
                'user'                               => 'JMARDZ',
                'location_id'                        => 1,
                'light_class_id'                     => 1,
                'color_structure_pattern_id'         => 1,
                'top_mark_id'                        => 1,
                'aid_type_id'                        => 1,
                'aid_type_form_id'                   => 1,
            ],
            [
                'racon'                              => 'no',
                'ais'                                => '2222',
                'height'                             => '4 m',
                'float_diameter'                     => '3.4 m',
                'elevation_nmm'                      => '5.22 m',
                'scope'                              => '5.17 m',
                'sector_angle'                       => '360°',
                'period'                             => '3 s',
                'features'                           => '0.6 s, OC 3.5 s',
                'created_at'                         => new \DateTime('now'),
                'updated_at'                         => new \DateTime('now'),
                'user'                               => 'JMARDZ',
                'location_id'                        => 1,
                'light_class_id'                     => 2,
                'color_structure_pattern_id'         => 2,
                'top_mark_id'                        => 2,
                'aid_type_id'                        => 2,
                'aid_type_form_id'                   => 2,
            ],
            [
                'racon'                              => 'no',
                'ais'                                => '33333',
                'height'                             => '4 m',
                'float_diameter'                     => '3.4 m',
                'elevation_nmm'                      => '5.22 m',
                'scope'                              => '5.17 m',
                'sector_angle'                       => '360°',
                'period'                             => '3 s',
                'features'                           => '0.7 s, OC 4.5 s',
                'created_at'                         => new \DateTime('now'),
                'updated_at'                         => new \DateTime('now'),
                'user'                               => 'JMARDZ',
                'location_id'                        => 1,
                'light_class_id'                     => 3,
                'color_structure_pattern_id'         => 3,
                'top_mark_id'                        => 3,
                'aid_type_id'                        => 3,
                'aid_type_form_id'                   => 3,
            ],
            [
                'racon'                              => 'no',
                'ais'                                => '44444',
                'height'                             => '6 m',
                'float_diameter'                     => '6.4 m',
                'elevation_nmm'                      => '7.22 m',
                'scope'                              => '8.17 m',
                'sector_angle'                       => '360°',
                'period'                             => '3 s',
                'features'                           => '0.9 s, OC 1.5 s',
                'created_at'                         => new \DateTime('now'),
                'updated_at'                         => new \DateTime('now'),
                'user'                               => 'JMARDZ',
                'location_id'                        => 1,
                'light_class_id'                     => 3,
                'color_structure_pattern_id'         => 4,
                'top_mark_id'                        => 3,
                'aid_type_id'                        => 4 ,
                'aid_type_form_id'                   => 4 ,
            ],
        ]);
    }
}
