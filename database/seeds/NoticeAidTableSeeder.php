<?php

use Illuminate\Database\Seeder;

class NoticeAidTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notice_aid')->insert([
            [
                'notice_id'        => 1,
                'aid_id'           => 1,
                'coordinate_id'    => 1,
                'created_at'       => new \DateTime('now'),
                'updated_at'       => new \DateTime('now'),
            ],
            [
                'notice_id'        => 2,
                'aid_id'           => 2,
                'coordinate_id'    => 2,
                'created_at'       => new \DateTime('now'),
                'updated_at'       => new \DateTime('now'),
            ],
        ]);
    }
}
