<?php

use Illuminate\Database\Seeder;

class SymbolTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('symbol_type')->insert([
            [
                'title' => 'Ayuda a la navegación',
                'code'          => 'A1',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA'
            ],
            [
                'title' => 'Peligro a la navegación',
                'code'          => 'D1',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA'
            ]
        ]);
    }
}
