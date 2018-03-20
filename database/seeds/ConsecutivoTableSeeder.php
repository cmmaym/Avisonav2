<?php

use Illuminate\Database\Seeder;

class ConsecutivoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('consecutivo')->insert([
            [
                'nombre' => 'tipo_aviso',
                'numero' => 1,
            ],
            [
                'nombre' => 'zona',
                'numero' => 1,
            ],
            [
                'nombre' => 'ubicacion',
                'numero' => 1,
            ],
            [
                'nombre' => 'tipo_color',
                'numero' => 1,
            ],
            [
                'nombre' => 'tipo_luz',
                'numero' => 1,
            ],
            [
                'nombre' => 'tipo_caracter',
                'numero' => 1,
            ]
        ]);
    }
}
