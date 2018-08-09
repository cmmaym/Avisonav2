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
                'description' => 'Boya cónica',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 1,
                'language_id'   => 1
            ],
            [
                'description' => 'Conical buoy',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 1,
                'language_id'   => 2
            ],
            [
                'description' => 'Boya cilíndrica',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 2,
                'language_id'   => 1
            ],
            [
                'description' => 'Cylindrical buoy',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 2,
                'language_id'   => 2
            ],
            [
                'description' => 'Boya esférica',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 3,
                'language_id'   => 1
            ],
            [
                'description' => 'Spherical buoy',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 3,
                'language_id'   => 2
            ],
            [
                'description' => 'Boya pilar',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 4,
                'language_id'   => 1
            ],
            [
                'description' => 'Pillar buoy',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 4,
                'language_id'   => 2
            ],
            [
                'description' => 'Boya de espeque',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 5,
                'language_id'   => 1
            ],
            [
                'description' => 'Spar buoy, Spindle buoy',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 5,
                'language_id'   => 2
            ],
            [
                'description' => 'Boya de barril',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 6,
                'language_id'   => 1
            ],
            [
                'description' => 'Barrel buoy',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 6,
                'language_id'   => 2
            ],
            [
                'description' => 'Superboya',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 7,
                'language_id'   => 1
            ],
            [
                'description' => 'Super buoy',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 7,
                'language_id'   => 2
            ],
            [
                'description' => 'Torre metálica',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 8,
                'language_id'   => 1
            ],
            [
                'description' => 'Metal tower',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 8,
                'language_id'   => 2
            ],
            [
                'description' => 'Torre de concreto',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 9,
                'language_id'   => 1
            ],
            [
                'description' => 'Concrete tower',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 9,
                'language_id'   => 2
            ],
            [
                'description' => 'Torre',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 10,
                'language_id'   => 1
            ],
            [
                'description' => 'Tower',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'aid_type_form_id' => 10,
                'language_id'   => 2
            ],
        ]);
    }
}
