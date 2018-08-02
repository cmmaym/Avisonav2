<?php

use Illuminate\Database\Seeder;

class AidColorLightTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aid_color_light')->insert([
            [
                'aid_id'        => 1,
                'color_light_id'      => 1,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'aid_id'        => 2,
                'color_light_id'      => 2,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'aid_id'        => 3,
                'color_light_id'      => 3,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'aid_id'        => 4,
                'color_light_id'      => 4,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
        ]);
    }
}
