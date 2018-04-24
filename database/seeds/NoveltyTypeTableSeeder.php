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
                'state'         => 'A',
            ],
            [
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'state'         => 'A',
            ],
            [
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'state'         => 'A',
            ],
            [
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'state'         => 'A',
            ]
        ]);
    }
}