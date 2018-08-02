<?php

use Illuminate\Database\Seeder;

class AidTypeFormLangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aid_type_form_lang')->insert([
            [
                'description' => 'Descripcion de la forma del tipo de ayuda 1',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 1,
                'language_id'   => 1
            ],
            [
                'description' => 'Aid form description 1',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 1,
                'language_id'   => 2
            ],
            [
                'description' => 'Descripcion de la forma del tipo de ayuda 2',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 2,
                'language_id'   => 1
            ],
            [
                'description' => 'Aid form description 2',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 2,
                'language_id'   => 2
            ],
            [
                'description' => 'Descripcion de la forma del tipo de ayuda 3',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 3,
                'language_id'   => 1
            ],
            [
                'description' => 'Aid form description 3',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 3,
                'language_id'   => 2
            ],
            [
                'description' => 'Descripcion de la forma del tipo de ayuda 4',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 4,
                'language_id'   => 1
            ],
            [
                'description' => 'Aid form description 4',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 4,
                'language_id'   => 2
            ],
        ]);
    }
}
