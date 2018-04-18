<?php

use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('location')->insert([
            [
                'name'                      => 'La Guajira',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Puerto Bolivar',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Puerto Nuevo',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Puerto Brisa',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Costa Norte',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 3
            ],
            [
                'name'                      => 'Bahia Solano',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 3
            ],
            [
                'name'                      => 'Arusi',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 3
            ],
            [
                'name'                      => 'Bahia Malaga',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 3
            ],
            [
                'name'                      => 'Buenaventura',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 3
            ],
        ]);
    }
}
