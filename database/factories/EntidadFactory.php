<?php

use Faker\Generator as Faker;

$factory->define(AvisoNavAPI\Entidad::class, function (Faker $faker) {
    return [
        'nombre' => $faker->unique()->name,
        'alias'  => $faker->unique()->userName,
    ];
});
