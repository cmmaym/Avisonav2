<?php

use Illuminate\Database\Seeder;

class CatalogOceanCoastTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('catalog_ocean_coast')->insert([
            [
                'edition'       => '5',
                'year'          => '2016',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
            ],

        ]);
    }
}
