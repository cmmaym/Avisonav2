<?php

use Illuminate\Database\Seeder;

class AidColorStructureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aid_color_structure')->insert([
            [
                'aid_id'        => 1,
                'color_structure_id'      => 1,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'aid_id'        => 2,
                'color_structure_id'      => 2,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'aid_id'        => 3,
                'color_structure_id'      => 3,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'aid_id'        => 4,
                'color_structure_id'      => 4,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
        ]);
    }
}
