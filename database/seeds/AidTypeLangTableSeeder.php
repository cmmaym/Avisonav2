<?php

use Illuminate\Database\Seeder;

class AidTypeLangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aid_type_lang')->insert([
            [
                'name'              => 'Faro',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 1,
                'aid_type_id'       => 1
            ],
            [
                'name'              => 'Headlight',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 2,
                'aid_type_id'       => 1
            ],
            [
                'name'              => 'Boya',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 1,
                'aid_type_id'       => 2
            ],
            [
                'name'              => 'Buoy',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 2,
                'aid_type_id'       => 2
            ],
            [
                'name'              => 'Baliza',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 1,
                'aid_type_id'       => 3
            ],
            [
                'name'              => 'Beacon',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 2,
                'aid_type_id'       => 3
            ],
            [
                'name'              => 'Boyarin',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 1,
                'aid_type_id'       => 4
            ],
            [
                'name'              => 'Boyarin',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 2,
                'aid_type_id'       => 4
            ],
            [
                'name'              => 'Luz de sector',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 1,
                'aid_type_id'       => 5
            ],
            [
                'name'              => 'Sector light',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 2,
                'aid_type_id'       => 5
            ],
            [
                'name'              => 'Enfilación',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 1,
                'aid_type_id'       => 6
            ],
            [
                'name'              => 'Leading',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'language_id'       => 2,
                'aid_type_id'       => 6
            ],
        ]);
    }
}
