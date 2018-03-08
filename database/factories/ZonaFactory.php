<?php

use AvisoNavAPI\Idioma;
use Faker\Generator as Faker;

$factory->define(AvisoNavAPI\Zona::class, function (Faker $faker) {

    $idioma = Idioma::all()->first();

    return [
        'nombre'  => $faker->state,
        'alias'   => $faker->stateAbbr,
        'cod_ide' => $faker->randomLetter,
        'idioma_id' => $idioma->idioma_id,
    ];
});
