<?php

use Illuminate\Database\Seeder;

class NoticeChartEditionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notice_chart_edition')->insert([
            [
                'notice_id'        => 1,
                'chart_edition_id'  => 1,
                'created_at'       => new \DateTime('now'),
                'updated_at'       => new \DateTime('now'),
            ],
            [
                'notice_id'        => 2,
                'chart_edition_id'  => 2,
                'created_at'       => new \DateTime('now'),
                'updated_at'       => new \DateTime('now'),
            ],
        ]);
    }
}
