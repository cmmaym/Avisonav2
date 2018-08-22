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
        DB::table('reporting_user')->insert([
            [
                'name'             => 'Johan Arciniegas Fajardo',
                'rank'              => 'TS23',
                'created_at'        => new \DateTime('now'),
                'updated_at'        => new \DateTime('now'),
                'report_source_id'  => 1
            ]
        ]);
    }
}
