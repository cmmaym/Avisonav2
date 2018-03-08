<?php

use Faker\Generator as Faker;

$factory->define(AvisoNavAPI\Carta::class, function (Faker $faker) {
    return [
        'numero'    => $faker->unique->numberBetween(100, 200),
        'edicion'   => 1,
        'ano'       => $faker->year,
        'cod_ide'   => $faker->randomLetter,
    ];
});
