<?php

use Faker\Generator as Faker;

$factory->define(AvisoNavAPI\Ubicacion::class, function (Faker $faker) {
    return [
        'ubicacion'     => $faker->city,
        'sub_ubicacion' => $faker->streetName,
    ];
});
