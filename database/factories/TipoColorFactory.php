<?php

use AvisoNavAPI\Idioma;
use Faker\Generator as Faker;

$factory->define(AvisoNavAPI\TipoColor::class, function (Faker $faker) {

    $idioma = Idioma::all()->first();

    return [
        'color'     => $faker->colorName,
        'alias'     => $faker->safeColorName,
        'idioma_id' => $idioma->id,
    ];
});