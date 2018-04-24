<?php

use Illuminate\Database\Seeder;

class NoveltyTypeLangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('novelty_type_lang')->insert([
            [
                'name'                  => 'Apagada',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'language_id'           => 1,
                'novelty_type_id'       => 1,
            ],
            [
                'name'                  => 'Off',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'language_id'           => 2,
                'novelty_type_id'       => 1
            ],
            [
                'name'                  => 'Establecida',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'language_id'           => 1,
                'novelty_type_id'       => 2,
            ],
            [
                'name'                  => 'Established',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'language_id'           => 2,
                'novelty_type_id'       => 2
            ],
            [
                'name'                  => 'Adicionar',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'language_id'           => 1,
                'novelty_type_id'       => 3,
            ],
            [
                'name'                  => 'Adding',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'language_id'           => 2,
                'novelty_type_id'       => 3
            ],
            [
                'name'                  => 'Suprimir',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'language_id'           => 1,
                'novelty_type_id'       => 4,
            ],
            [
                'name'                  => 'Delete',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'language_id'           => 2,
                'novelty_type_id'       => 4
            ],
        ]);
    }
}