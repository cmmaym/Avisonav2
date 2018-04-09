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
        DB::table('idioma')->insert([
            [
                'nombre' => 'Spanish',
                'alias'  => 'es',
                'created_at' => new \DateTime('now'),
                'updated_at' => new \DateTime('now')
            ],
            [
                'nombre' => 'Ingles',
                'alias'  => 'en',
                'created_at' => new \DateTime('now'),
                'updated_at' => new \DateTime('now')
            ]
        ]);
    }
}
