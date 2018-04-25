<?php

use Illuminate\Database\Seeder;

class NoticeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notice')->insert([
            [
                'number'                => '001',
                'date'                  => new \DateTime('now'),
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'periodo'               => '201804',
                'state'                 => 'A',
                'file_info'             => null,
                'user'                  => 'JMARDZ',
                'entity_id'             => 1,
                'character_type_id'     => 1,
                'parent_id'             => null,
            ],
            [
                'number'                => '002',
                'date'                  => new \DateTime('now'),
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'periodo'               => '201804',
                'state'                 => 'A',
                'file_info'             => null,
                'user'                  => 'JMARDZ',
                'entity_id'             => 2,
                'character_type_id'     => 1,
                'parent_id'             => null,
            ],
            [
                'number'                => '003',
                'date'                  => new \DateTime('now'),
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'periodo'               => '201804',
                'state'                 => 'A',
                'file_info'             => null,
                'user'                  => 'JMARDZ',
                'entity_id'             => 3,
                'character_type_id'     => 2,
                'parent_id'             => null,
            ],
            [
                'number'                => '004',
                'date'                  => new \DateTime('now'),
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'periodo'               => '201804',
                'state'                 => 'A',
                'file_info'             => null,
                'user'                  => 'JMARDZ',
                'entity_id'             => 4,
                'character_type_id'     => 2,
                'parent_id'             => null,
            ],
        ]);
    }
}
