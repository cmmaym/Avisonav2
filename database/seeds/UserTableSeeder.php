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
                'name'          => 'Jefferson',
                'email'         => 'jefers16@gmail.com',
                'password'      => Hash::make('123456'),
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'role_id'       => 1
            ],
        ]);
    }
}
