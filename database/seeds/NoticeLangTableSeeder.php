<?php

use Illuminate\Database\Seeder;

class NoticeLangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notice_lang')->insert([
            [
                'observation'           => 'Esto es un texo de prueba aviso 001',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'notice_id'             => 1,
                'language_id'           => 1
            ],
            [
                'observation'           => 'This is a test text 001',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'notice_id'             => 1,
                'language_id'           => 2
            ],
            [
                'observation'           => 'Esto es un texo de prueba 002',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'notice_id'             => 2,
                'language_id'           => 1
            ],
            [
                'observation'           => 'This is a test text 002',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'notice_id'             => 2,
                'language_id'           => 2
            ],
            [
                'observation'           => 'Esto es un texo de prueba 003',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'notice_id'             => 3,
                'language_id'           => 1
            ],
            [
                'observation'           => 'This is a test text 003',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'notice_id'             => 3,
                'language_id'           => 2
            ],
            [
                'observation'           => 'Esto es un texo de prueba 004',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'notice_id'             => 4,
                'language_id'           => 1
            ],
            [
                'observation'           => 'This is a test text 004',
                'created_at'            => new \DateTime('now'),
                'updated_at'            => new \DateTime('now'),
                'notice_id'             => 4,
                'language_id'           => 2
            ],
        ]);
    }
}
