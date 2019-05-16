<?php

use Illuminate\Database\Seeder;

class CharacterTypeLangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('character_type_lang')->insert([
            [
                'name'                  => 'General',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'           => 1,
                'character_type_id'     => 1
            ],
            [
                'name'                  => 'General',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'           => 2,
                'character_type_id'     => 1
            ],
            [
                'name'                  => 'Temporal',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'           => 1,
                'character_type_id'     => 2
            ],
            [
                'name'                  => 'Temporary',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'           => 2,
                'character_type_id'     => 2
            ],
            [
                'name'                  => 'Permanente',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'           => 1,
                'character_type_id'     => 3
            ],
            [
                'name'                  => 'Permanent',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'language_id'           => 2,
                'character_type_id'     => 3
            ],
        ]);
    }
}
