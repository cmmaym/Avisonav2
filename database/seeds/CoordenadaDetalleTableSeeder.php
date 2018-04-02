<?php

use Illuminate\Database\Seeder;

class CoordenadaDetalleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(AvisoNavAPI\CoordenadaDetalle::class, 1)->create();
    }
}
