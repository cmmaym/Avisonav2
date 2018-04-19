<?php

use Illuminate\Database\Seeder;

class ChartEditionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chart_edition')->insert([
            [
                'number'        => '1',
                'year'          => '2018',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'chart_id'      => 1
            ],
            [
                'number'        => '1',
                'year'          => '2018',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'chart_id'      => 2
            ],
            [
                'number'        => '1',
                'year'          => '2018',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'chart_id'      => 3
            ],
            [
                'number'        => '1',
                'year'          => '2018',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'chart_id'      => 4
            ],
            [
                'number'        => '1',
                'year'          => '2018',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'chart_id'      => 5
            ],
            [
                'number'        => '1',
                'year'          => '2018',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'chart_id'      => 6
            ],
        ]);
    }
}
