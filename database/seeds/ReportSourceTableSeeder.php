<?php

use Illuminate\Database\Seeder;

class ReportSourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('report_source')->insert([
            [
                'name'             => 'Grupo SEMAB',
                'alias'             => 'SEMAB',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'is_legacy'     => 0
            ],
            [
                'name'             => 'Grupo SEMAC',
                'alias'             => 'SEMAC',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'is_legacy'     => 0
            ],
            [
                'name'             => 'Grupo SEMAP',
                'alias'             => 'SEMAP',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'is_legacy'     => 0
            ]
        ]);
    }
}
