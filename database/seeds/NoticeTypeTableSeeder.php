<?php

use Illuminate\Database\Seeder;

class NoticeTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notice_type')->insert([
            [
                'name'          => 'Apagada',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'state'         => 'A',
                'language_id'   => 1,
                'parent_id'     => null,
            ],
            [
                'name'          => 'Off',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'state'         => 'A',
                'language_id'   => 2,
                'parent_id'     => 1
            ],
            [
                'name'          => 'Establecida',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'state'         => 'A',
                'language_id'   => 1,
                'parent_id'     => null,
            ],
            [
                'name'          => 'Established',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'state'         => 'A',
                'language_id'   => 2,
                'parent_id'     => 3
            ],
            [
                'name'          => 'Adicionar',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'state'         => 'A',
                'language_id'   => 1,
                'parent_id'     => null,
            ],
            [
                'name'          => 'Adding',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'state'         => 'A',
                'language_id'   => 2,
                'parent_id'     => 5
            ],
            [
                'name'          => 'Suprimir',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'state'         => 'A',
                'language_id'   => 1,
                'parent_id'     => null,
            ],
            [
                'name'          => 'Delete',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'state'         => 'A',
                'language_id'   => 2,
                'parent_id'     => 7
            ],
        ]);
    }
}