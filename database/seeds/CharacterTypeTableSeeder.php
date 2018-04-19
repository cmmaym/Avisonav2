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
                'name'          => 'General',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 1,
                'parent_id'     => null
            ],
            [
                'name'          => 'General',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 2,
                'parent_id'     => 1
            ],
            [
                'name'          => 'Temporal',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 1,
                'parent_id'     => null
            ],
            [
                'name'          => 'Temporary',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 2,
                'parent_id'     => 3
            ],
            [
                'name'          => 'Permanente',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 1,
                'parent_id'     => null
            ],
            [
                'name'          => 'Permanent',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'language_id'   => 2,
                'parent_id'     => 5
            ],
        ]);
    }
}
