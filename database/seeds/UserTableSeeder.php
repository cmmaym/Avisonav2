<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            [
                'num_ide'       => '1143333278',
                'username'     => 'jmartinezd',
                'name1'         => 'Jefferson',
                'name2'         => null,
                'last_name1'    => 'Martinez',
                'last_name2'    => 'Diaz',
                'email'         => 'jefers16@gmail.com',
                'password'      => Hash::make('123456'),
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'state'         => 'A',
                'role_id'       => 1
            ]
        ]);
    }
}
