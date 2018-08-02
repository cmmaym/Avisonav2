<?php

use Illuminate\Database\Seeder;

class FormTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('form_type')->insert([
            [
                'aid_type_id'   => 1,
                'aid_type_form_id' => 1,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'aid_type_id'   => 2,
                'aid_type_form_id' => 2,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'aid_type_id'   => 3,
                'aid_type_form_id' => 3,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'aid_type_id'   => 4,
                'aid_type_form_id' => 4,
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
        ]);
    }
}
