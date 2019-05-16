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
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA'
            ],
            [
                'alias'         => 'Oc',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA'
            ],
            [
                'alias'         => 'Iso',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA'
            ],
            [
                'alias'         => 'FI',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA'
            ],
            [
                'alias'         => 'Q',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA'
            ],
            [
                'alias'         => 'IQ',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA'
            ],
            [
                'alias'         => 'VQ',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA'
            ],
            [
                'alias'         => 'IVQ',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA'
            ],
            [
                'alias'         => 'UQ',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA'
            ],
            [
                'alias'         => 'IUQ',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA'
            ],
            [
                'alias'         => 'Mo',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA'
            ],
            [
                'alias'         => 'F FI',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA'
            ],
            [
                'alias'         => 'AI.WR',
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA'
            ],
        ]);
    }
}
