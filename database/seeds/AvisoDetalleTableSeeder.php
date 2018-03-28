<?php

use Illuminate\Database\Seeder;

class AvisoDetalleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $num = 0;
        factory(AvisoNavAPI\AvisoDetalle::class, 4)->create()->each(function ($item, $key) use (&$num){

            if($key % 2 == 0){
                //$item->aviso_id = $item->id;
                $num = $item->id;
            }

            if(($key+1) % 2 == 0){
                $item->aviso_id = $num;
                $item->tipo_aviso_id = 2;
                $item->tipo_caracter_id = 2;
                $item->idioma_id = 2;
            }

            $item->save();
        });
    }
}
