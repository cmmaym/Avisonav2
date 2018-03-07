<?php

use Illuminate\Database\Seeder;

class TipoAvisoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(AvisoNavAPI\TipoAviso::class, 2)->create();
    }
}
