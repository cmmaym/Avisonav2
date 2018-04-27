<?php

use Illuminate\Database\Seeder;

class CoordinateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        DB::table('coordinate')->insert([
            [
                'latitud'     => $faker->latitude(),
                'longitud'    => $faker->longitude(),
                'created_at'       => new \DateTime('now'),
                'updated_at'       => new \DateTime('now'),
                'aid_id'      => 1
            ],
            [
                'latitud'     => $faker->latitude(),
                'longitud'    => $faker->longitude(),
                'created_at'       => new \DateTime('now'),
                'updated_at'       => new \DateTime('now'),
                'aid_id'      => 2
            ],
            [
                'latitud'     => $faker->latitude(),
                'longitud'    => $faker->longitude(),
                'created_at'       => new \DateTime('now'),
                'updated_at'       => new \DateTime('now'),
                'aid_id'      => 3
            ],
            [
                'latitud'     => $faker->latitude(),
                'longitud'    => $faker->longitude(),
                'created_at'       => new \DateTime('now'),
                'updated_at'       => new \DateTime('now'),
                'aid_id'      => 4
            ],
        ]);
    }
}
