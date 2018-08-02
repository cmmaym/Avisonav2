<?php

use Illuminate\Database\Seeder;

class AidChartTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aid_chart')->insert([
            [
                'chart_id'      => 1,
                'aid_id'        => 1,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'chart_id'      => 2,
                'aid_id'        => 2,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'chart_id'      => 3,
                'aid_id'        => 3,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
        ]);
    }
}
