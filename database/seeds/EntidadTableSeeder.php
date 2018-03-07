<?php

use Illuminate\Database\Seeder;

class EntidadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(AvisoNavAPI\Entidad::class, 10)->create();
    }
}
