<?php

use Illuminate\Database\Seeder;

class AidTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aid_type')->insert([
            [
                'name'          => 'Faro',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 1,
                'parent_id'     => null
            ],
            [
                'name'          => 'Headlight',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 2,
                'parent_id'     => 1
            ],
            [
                'name'          => 'Boya',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 1,
                'parent_id'     => null
            ],
            [
                'name'          => 'Buoy',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 2,
                'parent_id'     => 3
            ],
            [
                'name'          => 'Beliza Enfilacion Rango Inferior',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 1,
                'parent_id'     => null
            ],
            [
                'name'          => 'Beacon Enfilacion Lower Range',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 2,
                'parent_id'     => 5
            ],
            [
                'name'          => 'Boyarin',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 1,
                'parent_id'     => null
            ],
            [
                'name'          => 'Boyarin',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 2,
                'parent_id'     => 7
            ],
        ]);
    }
}
