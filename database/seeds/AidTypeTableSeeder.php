<?php

use Illuminate\Database\Seeder;

class AidTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aid_type')->insert([
            [
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'illustration'  => null,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
        ]);
    }
}
