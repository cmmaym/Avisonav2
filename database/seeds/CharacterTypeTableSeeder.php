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
                'alias'         => 'G',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA'
            ],
            [
                'alias'         => 'T',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA'
            ],
            [
                'alias'         => 'P',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA'
            ]
        ]);
    }
}
