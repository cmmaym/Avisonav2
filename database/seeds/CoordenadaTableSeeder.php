<?php

use Illuminate\Database\Seeder;

class CoordenadaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(AvisoNavAPI\Coordenada::class, 1)->create();
    }
}
