<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::statement('TRUNCATE TABLE idioma;');
        DB::statement('TRUNCATE TABLE entidad;');
        DB::statement('TRUNCATE TABLE tipo_aviso;');
        
        // $this->call(UsersTableSeeder::class);
        $this->call(IdiomaTableSeeder::class);
        $this->call(EntidadTableSeeder::class);
        //$this->call(TipoAvisoTableSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}