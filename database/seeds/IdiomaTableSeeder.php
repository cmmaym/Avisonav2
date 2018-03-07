<?php


use Illuminate\Database\Seeder;

class IdiomaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(AvisoNavAPI\Idioma::class, 2)->create();
    }
}
