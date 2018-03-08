<?php

use Illuminate\Database\Seeder;

class AvisoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {               
        factory(AvisoNavAPI\Aviso::class, 4)->create()->each(function ($item, $key){
            
            // if($key % 2 == 0){
            //     $cod_ide = $item->tipo_aviso_id;
            // }

            // if(($key+1) % 2 == 0){
            //     $item->idioma_id = 2;
            // }
            
            // $item->cod_ide = $cod_ide;
            // $item->save();
        }); 
    }
}
