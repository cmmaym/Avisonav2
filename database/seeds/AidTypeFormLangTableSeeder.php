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
                'description' => 'Cónica',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 1,
                'language_id'   => 1
            ],
            [
                'description' => 'Conic',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 1,
                'language_id'   => 2
            ],
            [
                'description' => 'Cilíndrica',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 2,
                'language_id'   => 1
            ],
            [
                'description' => 'Cylindrical',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 2,
                'language_id'   => 2
            ],
            [
                'description' => 'Esférica',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 3,
                'language_id'   => 1
            ],
            [
                'description' => 'Spherical',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 3,
                'language_id'   => 2
            ],
            [
                'description' => 'Pilar',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 4,
                'language_id'   => 1
            ],
            [
                'description' => 'Pillar',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 4,
                'language_id'   => 2
            ],
        ]);
    }
}
