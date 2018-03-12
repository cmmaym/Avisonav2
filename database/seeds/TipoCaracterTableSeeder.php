<?php

use Illuminate\Database\Seeder;

class TipoCaracterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cod_ide = 0;        
        factory(AvisoNavAPI\TipoCaracter::class, 6)->create()->each(function ($item, $key) use (&$cod_ide){
            
            if($key % 2 == 0){
                $cod_ide = $item->tipo_carac_id;
            }

            if(($key+1) % 2 == 0){
                $item->idioma_id = 2;
            }
            
            $item->cod_ide = $cod_ide;
            $item->save();
        }); 
    }
}