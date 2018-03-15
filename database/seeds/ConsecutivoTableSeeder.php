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
            'nombre' => 'tipo_aviso',
            'numero' => 1,
        ]);
    }
}
