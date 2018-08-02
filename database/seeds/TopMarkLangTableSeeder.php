<?php

use Illuminate\Database\Seeder;

class TopMarkLangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('top_mark_lang')->insert([
            [
                'description'  => 'Esto es un texto de pruebas 001',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'top_mark_id'   => 1,
                'language_id'   => 1
            ],
            [
                'description'  => 'This is a text test 001',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'top_mark_id'   => 1,
                'language_id'   => 2
            ],
            [
                'description'  => 'Esto es un texto de pruebas 002',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'top_mark_id'   => 2,
                'language_id'   => 1
            ],
            [
                'description'  => 'This is a text test 002',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'top_mark_id'   => 2,
                'language_id'   => 2
            ],
            [
                'description'  => 'Esto es un texto de pruebas 003',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'top_mark_id'   => 3,
                'language_id'   => 1
            ],
            [
                'description'  => 'This is a text test 003',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'top_mark_id'   => 3,
                'language_id'   => 2
            ],
        ]);
    }
}
