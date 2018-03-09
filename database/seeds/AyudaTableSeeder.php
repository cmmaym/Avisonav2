<?php

use Illuminate\Database\Seeder;

class AyudaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $numero = 0;
        factory(AvisoNavAPI\Ayuda::class, 6)->create()->each(function ($item, $key) use (&$numero){

            if($key % 2 == 0){
                $numero = $item->ayuda_id;
                $item->numero = $numero;
            }
            
            if(($key+1) % 2 == 0){
                $item->idioma_id = 2;
                $item->numero = $numero;
                $item->ubicacion_id = 2;
            }
            
            $item->save();
        }); 
    }
}
