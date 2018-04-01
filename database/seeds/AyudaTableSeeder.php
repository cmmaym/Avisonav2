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
        factory(AvisoNavAPI\Ayuda::class, 6)->create();
    }
}
