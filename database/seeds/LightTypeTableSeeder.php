<?php

use Illuminate\Database\Seeder;

class LightTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('light_type')->insert([
            [
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
        ]);
    }
}
