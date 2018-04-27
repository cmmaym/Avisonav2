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
                'purpose'     => 'Oceanica',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'user'          => 'JMARDZ'
            ],
            [
                'number'        => '002',
                'purpose'     => 'General',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'user'          => 'JMARDZ'
            ],
            [
                'number'        => '003',
                'purpose'     => 'Costera',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'user'          => 'JMARDZ'
            ],
            [
                'number'        => '004',
                'purpose'     => 'Aproximacion',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'user'          => 'JMARDZ'
            ],
            [
                'number'        => '005',
                'purpose'     => 'Puerto',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'user'          => 'JMARDZ'
            ],
            [
                'number'        => '006',
                'purpose'     => 'Canales o Muelles',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'user'          => 'JMARDZ'
            ]
        ]);
    }
}