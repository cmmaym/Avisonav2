<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert([
            [
                'name'          => 'ROLE_ADMIN',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'state'         => 'A'
            ],
            [
                'name'          => 'ROLE_USER',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'state'         => 'A'
            ],
        ]);
    }
}
