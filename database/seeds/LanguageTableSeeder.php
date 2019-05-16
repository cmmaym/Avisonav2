<?php


use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('language')->insert([
            [
                'name' => 'Español',
                'code'  => 'es',
                'created_at' => new \DateTime('now'),
                'updated_at' => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA'
            ],
            [
                'name' => 'Ingles',
                'code'  => 'en',
                'created_at' => new \DateTime('now'),
                'updated_at' => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA'
            ]
        ]);
    }
}
