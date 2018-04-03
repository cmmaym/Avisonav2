<?php

use Faker\Generator as Faker;

$factory->define(AvisoNavAPI\Coordenada::class, function (Faker $faker) {
    return [
        'latitud'   =>  $faker->latitude(),
        'longitud'  =>  $faker->longitude(),
        'altitud'   =>  $faker->randomDigit,
        'alcance'   =>  $faker->randomDigit,
        'cantidad'  =>  $faker->randomDigit,        
        'ayuda_id'  =>  1,
    ];
});
