<?php

use Illuminate\Database\Seeder;

class UbicacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        
        factory(AvisoNavAPI\Ubicacion::class, 10)->create()->each(function ($item, $key) use (&$cod_ide){

            if($key % 2 == 0){
                $item->sub_ubicacion = null;
                $item->save();
            }

        }); 
    }
}
