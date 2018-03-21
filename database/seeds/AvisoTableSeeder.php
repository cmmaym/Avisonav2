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
        $num_aviso = 0;
        factory(AvisoNavAPI\Aviso::class, 4)->create()->each(function ($item, $key) use (&$num_aviso){
            
            $item->periodo = $item->fecha->format('Ym');

            if($key % 2 == 0){
                $num_aviso = $item->id;
                $item->num_aviso = $num_aviso;
            }

            if(($key+1) % 2 == 0){
                $item->idioma_id = 2;
                $item->num_aviso = $num_aviso;
            }
            
            $item->save();
        }); 
    }
}
