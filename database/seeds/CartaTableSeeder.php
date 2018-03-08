<?php

use Illuminate\Database\Seeder;

class CartaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cod_ide = 0;        
        factory(AvisoNavAPI\Carta::class, 20)->create()->each(function ($item, $key) use (&$cod_ide){
            $item->cod_ide = $item->carta_id;
            $item->save();
        }); 
    }
}
