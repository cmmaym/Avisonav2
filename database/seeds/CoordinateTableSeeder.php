<?php

use Illuminate\Database\Seeder;

class CoordinateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(AvisoNavAPI\Coordinate::class, 2)->create();
    }
}
