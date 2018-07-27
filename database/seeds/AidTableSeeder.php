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
                'number'                => null,
                'sub_name'              => 'De castillete',
                'elevation'             => 3,
                'scope'                 => 2,
                'quantity'              => 3,
                'observation'           => 'FI (2) 3 s',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'user'                  => 'JMARDZ',
                'aid_type_id'           => 1,
                'location_id'           => 1,
                'light_type_id'         => 1,
                'color_type_id'         => 1,
            ],
            [
                'number'                => null,
                'sub_name'              => 'X 10',
                'elevation'             => 4,
                'scope'                 => 2,
                'quantity'              => 3,
                'observation'           => 'FI (2) 3 s',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'user'                  => 'JMARDZ',
                'aid_type_id'           => 1,
                'location_id'           => 1,
                'light_type_id'         => 2,
                'color_type_id'         => 2,
            ],
            [
                'number'                => null,
                'sub_name'              => 'De aguas seguras',
                'elevation'             => 5,
                'scope'                 => 2,
                'quantity'              => 3,
                'observation'           => 'FI (2) 3 s',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'user'                  => 'JMARDZ',
                'aid_type_id'           => 3,
                'location_id'           => 1,
                'light_type_id'         => 3,
                'color_type_id'         => 3,
            ],
            [
                'number'                => null,
                'sub_name'              => 'B1',
                'elevation'             => 3,
                'scope'                 => 2,
                'quantity'              => 3,
                'observation'           => 'FI (2) 3 s',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'user'                  => 'JMARDZ',
                'aid_type_id'           => 4 ,
                'location_id'           => 1,
                'light_type_id'         => 3,
                'color_type_id'         => 2,
            ],
        ]);
    }
}
