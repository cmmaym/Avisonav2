<?php

use Faker\Generator as Faker;
use AvisoNavAPI\Idioma;

$factory->define(AvisoNavAPI\TipoAviso::class, function (Faker $faker) {

    $idioma = Idioma::all()->first();

    return [
        'nombre'    => $faker->unique()->words,
        //'cod_ide'   => $faker->randomLetter,
        //'idioma_id' => 1,
    ];
});
