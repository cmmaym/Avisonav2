<?php

use Faker\Generator as Faker;

$factory->define(AvisoNavAPI\Ayuda::class, function (Faker $faker) {
    return [
        'numero'        => $faker->unique->numberBetween($min = 1, $max = 1000),
        'nombre'        => $faker->word,
        'version'       => 1,
        'user_id'    => 1,
        'ubicacion_id'   => 1
    ];
});
