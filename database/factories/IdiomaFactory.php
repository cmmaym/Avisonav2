<?php

use Faker\Generator as Faker;

$factory->define(AvisoNavAPI\Idioma::class, function (Faker $faker) {
    return [
        'nombre' => $faker->unique()->word,
        'alias'  => $faker->unique()->tld,
    ];
});