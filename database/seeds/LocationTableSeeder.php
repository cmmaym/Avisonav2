<?php

use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('location')->insert([
            //Zona Caribe
            [
                'name'                      => 'Puerto Bolivar',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Puerto Nuevo',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Puerto Brisa',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Plataforma Chuchupa "A"',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Plataforma Chuchupa "B"',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Santa Marta',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Aproximación a Drummond',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Aproximación a Puerto Nuevo S.A',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Aproximación Sociedad Portuaria Rio Córdoba',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Río Magdalena',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Ensenada de Trebal',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Cartagena',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Canal Bahía de las Ánimas',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Sector Compas',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Sector Isla de Manzanillo',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Contecar',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Sociedad Portuaria El Cayo S.A',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Archipiélago Islas del Rosario',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Archipiélago de San Bernardo',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Ciénaga de Cholón',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Golfo de Morrosquillo',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Isla Tortuguilla - Cabo tiburón - Bahía Colombia',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Sapzurro',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Capurganá',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Bahía de Turbo',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Aproximación desembocadura rio León',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Isla de San Andrés',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            [
                'name'                      => 'Isla de Providencia',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 1
            ],
            //Zona Pacifico
            [
                'name'                      => 'Bahia Solano',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 2
            ],
            [
                'name'                      => 'Arusí',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 2
            ],
            [
                'name'                      => 'Bahia Málaga',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 2
            ],
            [
                'name'                      => 'Buenaventura',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 2
            ],
            [
                'name'                      => 'Sociedad Portuaria Agua Dulce',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 2
            ],
            [
                'name'                      => 'Terminal de Contenedores de Buenaventura (TcBuen)',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 2
            ],
            [
                'name'                      => 'Punta Coll a Cabo Manglares',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 2
            ],
            [
                'name'                      => 'Bocana Amarales',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 2
            ],
            [
                'name'                      => 'Tumaco',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 2
            ],
            [
                'name'                      => 'Isla Malpelo',
                'sub_location_name'         => null,
                'created_at'                => new \DateTime('now'),
                'updated_at'                => new \DateTime('now'),
                'zone_id'                   => 2
            ],
        ]);
    }
}
