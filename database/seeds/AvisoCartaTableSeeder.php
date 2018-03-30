<?php

use Illuminate\Database\Seeder;

class AvisoCartaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aviso = \AvisoNavAPI\Aviso::all();
        $carta = \AvisoNavAPI\Carta::all(['id'])->pluck('id');

        $aviso->each(function($item) use ($carta){
            $item->carta()->sync($carta->random(5));
        });
    }
}
