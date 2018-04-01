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
        DB::statement('TRUNCATE TABLE zona;');
        DB::statement('TRUNCATE TABLE ubicacion;');
        DB::statement('TRUNCATE TABLE tipo_color;');
        DB::statement('TRUNCATE TABLE tipo_luz;');
        DB::statement('TRUNCATE TABLE tipo_caracter;');
        DB::statement('TRUNCATE TABLE carta;');
        DB::statement('TRUNCATE TABLE aviso;');
        DB::statement('TRUNCATE TABLE aviso_detalle;');
        DB::statement('TRUNCATE TABLE ayuda;');
        DB::statement('TRUNCATE TABLE aviso_carta;');
        DB::statement('TRUNCATE TABLE coordenada;');
        DB::statement('TRUNCATE TABLE coordenada_detalle;');

        // $this->call(UsersTableSeeder::class);
        $this->call(IdiomaTableSeeder::class);
        $this->call(EntidadTableSeeder::class);
        $this->call(TipoAvisoTableSeeder::class);
        $this->call(ZonaTableSeeder::class);
        $this->call(UbicacionTableSeeder::class);
        $this->call(TipoColorTableSeeder::class);
        $this->call(TipoLuzTableSeeder::class);
        $this->call(TipoCaracterTableSeeder::class);
        $this->call(CartaTableSeeder::class);
        $this->call(AvisoTableSeeder::class);
        $this->call(AvisoDetalleTableSeeder::class);
        $this->call(AyudaTableSeeder::class);
        $this->call(AvisoCartaTableSeeder::class);
        $this->call(CoordenadaTableSeeder::class);
        $this->call(CoordenadaDetalleTableSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}