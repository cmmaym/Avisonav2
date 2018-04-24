<?php

use Illuminate\Database\Seeder;

class ZoneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('zone')->insert([
            [
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now')
            ],
            [
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now')
            ]
        ]);
    }
}
