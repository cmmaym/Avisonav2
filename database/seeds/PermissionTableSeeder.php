<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission')->insert([
            [
                'name'          => 'read',
                'description'   => 'Permite el acceso para obtener un recurso',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'name'          => 'create',
                'description'   => 'Permite el acceso para crear un recurso',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'name'          => 'delete',
                'description'   => 'Permite el acceso para eliminar un recurso',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'name'          => 'update',
                'description'   => 'Permite el acceso para actualizar un recurso',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
            [
                'name'          => 'user',
                'description'   => 'Permite realizar operaciones sobre los usuarios',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],
        ]);
    }
}
