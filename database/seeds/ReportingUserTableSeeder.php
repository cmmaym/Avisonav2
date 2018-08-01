<?php

use Illuminate\Database\Seeder;

class ReportingUserTableSeeder extends Seeder
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
                'name'             => 'Johan Arciniegas Fajardo',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'report_source_id'  => 1
            ],
            [
                'name'             => 'Eduardo Nuñez',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'report_source_id'  => 2
            ],
            [
                'name'             => 'rafael Diaz',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'report_source_id'  => 3
            ]
        ]);
    }
}
