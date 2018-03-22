<?php

use Illuminate\Database\Seeder;

class TipoColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cod_ide = 0;        
        factory(AvisoNavAPI\TipoColor::class, 8)->create()->each(function ($item, $key) use (&$cod_ide){            

            if($key % 2 == 0){
                $cod_ide = $item->id;
            }

            if(($key+1) % 2 == 0){
                $item->idioma_id = 2;
                $item->parent_id = $cod_ide;
            }            
            
            $item->save();
        }); 
    }
}
