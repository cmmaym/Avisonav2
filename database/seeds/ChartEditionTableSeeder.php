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
                'edition'        => '1',
                'year'          => '2018',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'chart_id'      => 1
            ],
            [
                'edition'        => '1',
                'year'          => '2018',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'chart_id'      => 2
            ],
            [
                'edition'        => '1',
                'year'          => '2018',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'chart_id'      => 3
            ],
            [
                'edition'        => '1',
                'year'          => '2018',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'chart_id'      => 4
            ],
            [
                'edition'        => '1',
                'year'          => '2018',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'chart_id'      => 5
            ],
            [
                'edition'        => '1',
                'year'          => '2018',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'chart_id'      => 6
            ],
        ]);
    }
}
