<?php

use Illuminate\Database\Seeder;

class TopMarkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('top_mark')->insert([
            [
                'image'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'image'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'image'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'image'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'image'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'image'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'image'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'image'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'image'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'image'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'image'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ]
        ]);
    }
}
