<?php

use Illuminate\Database\Seeder;

class CharacterTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('character_type')->insert([
            [
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ]
        ]);
    }
}
