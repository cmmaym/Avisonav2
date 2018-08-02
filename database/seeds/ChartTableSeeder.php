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
            [
                'number'        => '001',
                'name'          => 'Cartagena',
                'purpose'     => 'Oceanica',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'user'          => 'JMARDZ'
            ],
            [
                'number'        => '002',
                'name'          => 'Barranquilla',
                'purpose'     => 'General',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'user'          => 'JMARDZ'
            ],
            [
                'number'        => '003',
                'name'          => 'Buenaventura',
                'purpose'     => 'Costera',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'user'          => 'JMARDZ'
            ],
            [
                'number'        => '004',
                'name'          => 'Santa marta',
                'purpose'     => 'Aproximacion',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'user'          => 'JMARDZ'
            ],
            [
                'number'        => '005',
                'name'          => 'Malaga',
                'purpose'     => 'Puerto',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'user'          => 'JMARDZ'
            ],
            [
                'number'        => '006',
                'name'          => 'Legisamo',
                'purpose'     => 'Canales o Muelles',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'user'          => 'JMARDZ'
            ]
        ]);
    }
}
