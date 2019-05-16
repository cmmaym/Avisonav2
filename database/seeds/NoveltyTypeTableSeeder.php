<?php

use Illuminate\Database\Seeder;

class NoveltyTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('novelty_type')->insert([
            [
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'is_legacy'     => 0
            ],
            [
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'is_legacy'     => 0
            ],
            [
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'is_legacy'     => 0
            ],
            [
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'is_legacy'     => 0
            ],
            [
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'is_legacy'     => 0
            ],
            [
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'is_legacy'     => 0
            ]
        ]);
    }
}