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
        $cod_ide = 0;        
        factory(AvisoNavAPI\TipoAviso::class, 8)->create()->each(function ($item, $key) use (&$cod_ide){
            
            if($key % 2 == 0){
                $cod_ide = $item->tipo_aviso_id;
            }

            if(($key+1) % 2 == 0){
                $item->idioma_id = 2;
            }
            
            $item->cod_ide = $cod_ide;
            $item->save();
        });     
    }
}