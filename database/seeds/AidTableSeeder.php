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
                'number'        => null,
                'sub_name'      => 'De castillete',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'user'          => 'JMARDZ',
                'aid_type_id'   => 1,
                'location_id'   => 1
            ],
            [
                'number'        => null,
                'sub_name'      => 'X 10',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'user'          => 'JMARDZ',
                'aid_type_id'   => 1,
                'location_id'   => 1
            ],
            [
                'number'        => null,
                'sub_name'      => 'De aguas seguras',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'user'          => 'JMARDZ',
                'aid_type_id'   => 3,
                'location_id'   => 1
            ],
            [
                'number'        => null,
                'sub_name'      => 'B1',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'user'          => 'JMARDZ',
                'aid_type_id'   => 7,
                'location_id'   => 1
            ],
        ]);
    }
}
