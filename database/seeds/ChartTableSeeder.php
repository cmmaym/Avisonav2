<?php

use Illuminate\Database\Seeder;

class ChartTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chart')->insert([
            // [//1
            //     'number'        => '007',
            //     'name'          => 'El Gran Caribe',
            //     'purpose'       => 'Carta oceánica o de travesía',
            //     'created_at'    => new \DateTime('now'),
            //     'updated_at'    => new \DateTime('now'),
            //     'user'          => 'jmartinezd'
            // ],
            // [//2
            //     'number'        => '004',
            //     'name'          => 'Archipiélago de San Andrés y Providencia',
            //     'purpose'       => 'Carta General',
            //     'created_at'    => new \DateTime('now'),
            //     'updated_at'    => new \DateTime('now'),
            //     'user'          => 'jmartinezd'
            // ],
            // [//3
            //     'number'        => '005',
            //     'name'          => 'Carta General del Caribe Colombiano',
            //     'purpose'       => 'Carta General',
            //     'created_at'    => new \DateTime('now'),
            //     'updated_at'    => new \DateTime('now'),
            //     'user'          => 'jmartinezd'
            // ],
            // [//4
            //     'number'        => '008 INT 4025',
            //     'name'          => 'Cabo Gracias a Dios a Santa Marta',
            //     'purpose'       => 'Carta General',
            //     'created_at'    => new \DateTime('now'),
            //     'updated_at'    => new \DateTime('now'),
            //     'user'          => 'jmartinezd'
            // ],
            // [//5
            //     'number'        => '020 INT 4126',
            //     'name'          => 'Pedro Bank a Isla Cayos de Quitasueño',
            //     'purpose'       => 'Carta General',
            //     'created_at'    => new \DateTime('now'),
            //     'updated_at'    => new \DateTime('now'),
            //     'user'          => 'jmartinezd'
            // ],
            // [//6
            //     'number'        => '021 INT 4124',
            //     'name'          => 'Cabo Gracias a Dios a Isla de San Andrés',
            //     'purpose'       => 'Carta General',
            //     'created_at'    => new \DateTime('now'),
            //     'updated_at'    => new \DateTime('now'),
            //     'user'          => 'jmartinezd'
            // ],
            // [//7
            //     'number'        => '022 INT 4122',
            //     'name'          => 'Isla de San Andrés a Golfo de los Mosquitos',
            //     'purpose'       => 'Carta General',
            //     'created_at'    => new \DateTime('now'),
            //     'updated_at'    => new \DateTime('now'),
            //     'user'          => 'jmartinezd'
            // ],
            // [//8
            //     'number'        => '023 INT 4120',
            //     'name'          => 'Golfo de los Mosquitos a Punta Mosquito',
            //     'purpose'       => 'Carta General',
            //     'created_at'    => new \DateTime('now'),
            //     'updated_at'    => new \DateTime('now'),
            //     'user'          => 'jmartinezd'
            // ],
            // [//9
            //     'number'        => '028',
            //     'name'          => 'Barranquilla a Punta Espada',
            //     'purpose'       => 'Carta General',
            //     'created_at'    => new \DateTime('now'),
            //     'updated_at'    => new \DateTime('now'),
            //     'user'          => 'jmartinezd'
            // ],
            // [//10
            //     'number'        => '029',
            //     'name'          => 'Golfo de Urabá a Barranquilla',
            //     'purpose'       => 'Carta General',
            //     'created_at'    => new \DateTime('now'),
            //     'updated_at'    => new \DateTime('now'),
            //     'user'          => 'jmartinezd'
            // ],
            // [//11
            //     'number'        => '402',
            //     'name'          => 'Punta Gallinas a Cabo Chichibacoa',
            //     'purpose'       => 'Carta Costera',
            //     'created_at'    => new \DateTime('now'),
            //     'updated_at'    => new \DateTime('now'),
            //     'user'          => 'jmartinezd'
            // ],
            // [//12
            //     'number'        => '403',
            //     'name'          => 'Cabo de la Vela a Punta Gallinas',
            //     'purpose'       => 'Carta Costera',
            //     'created_at'    => new \DateTime('now'),
            //     'updated_at'    => new \DateTime('now'),
            //     'user'          => 'jmartinezd'
            // ],
            // [//13
            //     'number'        => '404',
            //     'name'          => 'Punta la Vela a Cabo de la Vela',
            //     'purpose'       => 'Carta Costera',
            //     'created_at'    => new \DateTime('now'),
            //     'updated_at'    => new \DateTime('now'),
            //     'user'          => 'jmartinezd'
            // ],
            // [//14
            //     'number'        => '406',
            //     'name'          => 'Santa Marta a Cabo San Agustín',
            //     'purpose'       => 'Carta Costera',
            //     'created_at'    => new \DateTime('now'),
            //     'updated_at'    => new \DateTime('now'),
            //     'user'          => 'jmartinezd'
            // ],
            // [//15
            //     'number'        => '407',
            //     'name'          => 'Puerto Colombia a Santa Marta',
            //     'purpose'       => 'Carta Costera',
            //     'created_at'    => new \DateTime('now'),
            //     'updated_at'    => new \DateTime('now'),
            //     'user'          => 'jmartinezd'
            // ],
            // [//16
            //     'number'        => '408',
            //     'name'          => 'Punta Canoas a Puerto Colombia',
            //     'purpose'       => 'Carta Costera',
            //     'created_at'    => new \DateTime('now'),
            //     'updated_at'    => new \DateTime('now'),
            //     'user'          => 'jmartinezd'
            // ],
            // [//17
            //     'number'        => '409',
            //     'name'          => 'Bajo Tortuguilla a Punta Canoas',
            //     'purpose'       => 'Carta Costera',
            //     'created_at'    => new \DateTime('now'),
            //     'updated_at'    => new \DateTime('now'),
            //     'user'          => 'jmartinezd'
            // ],
            // [//18
            //     'number'        => '410',
            //     'name'          => 'Isla Fuerte a Punta Comisario',
            //     'purpose'       => 'Carta Costera',
            //     'created_at'    => new \DateTime('now'),
            //     'updated_at'    => new \DateTime('now'),
            //     'user'          => 'jmartinezd'
            // ],
        ]);
    }
}
