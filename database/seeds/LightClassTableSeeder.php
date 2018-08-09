<?php

use Illuminate\Database\Seeder;

class LightClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('light_class')->insert([
            [
                'alias'         => 'F',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'alias'         => 'Oc',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'alias'         => 'Iso',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'alias'         => 'FI',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'alias'         => 'Q',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'alias'         => 'IQ',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'alias'         => 'VQ',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'alias'         => 'IVQ',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'alias'         => 'UQ',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'alias'         => 'IUQ',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'alias'         => 'Mo',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'alias'         => 'F FI',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'alias'         => 'AI.WR',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
        ]);
    }
}
