<?php

use Illuminate\Database\Seeder;

class AidLangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aid_lang')->insert([
            [
                'name'             => 'Boya n° 1',
                'created_at'       => new \DateTime('now'),
                'updated_at'       => new \DateTime('now'),
                'aid_id'           => 1,
                'language_id'      => 1,
            ],
            [
                'name'             => 'Boy n° 1',
                'created_at'       => new \DateTime('now'),
                'updated_at'       => new \DateTime('now'),
                'aid_id'           => 1,
                'language_id'      => 2,
            ],
            [
                'name'             => 'Boya n° 2',
                'created_at'       => new \DateTime('now'),
                'updated_at'       => new \DateTime('now'),
                'aid_id'           => 2,
                'language_id'      => 1,
            ],
            [
                'name'             => 'Boy n° 2',
                'created_at'       => new \DateTime('now'),
                'updated_at'       => new \DateTime('now'),
                'aid_id'           => 2,
                'language_id'      => 2,
            ],
            [
                'name'             => 'Faro buenaventura',
                'created_at'       => new \DateTime('now'),
                'updated_at'       => new \DateTime('now'),
                'aid_id'           => 3,
                'language_id'      => 1,
            ],
            [
                'name'             => 'Headlight buenaventura',
                'created_at'       => new \DateTime('now'),
                'updated_at'       => new \DateTime('now'),
                'aid_id'           => 3,
                'language_id'      => 2,
            ],
            [
                'name'             => 'Enfilacion n° 1',
                'created_at'       => new \DateTime('now'),
                'updated_at'       => new \DateTime('now'),
                'aid_id'           => 4,
                'language_id'      => 1,
            ],
            [
                'name'             => 'Beacon enfilacion n° 1',
                'created_at'       => new \DateTime('now'),
                'updated_at'       => new \DateTime('now'),
                'aid_id'           => 4,
                'language_id'      => 2,
            ],
        ]);
    }
}
