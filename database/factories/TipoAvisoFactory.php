<?php

use Faker\Generator as Faker;
use AvisoNavAPI\Idioma;

$factory->define(AvisoNavAPI\TipoAviso::class, function (Faker $faker) {

    $idioma = Idioma::all()->first();

    return [
        'nombre'    =>  $faker->name,
        'cod_ide'   =>  $faker->randomLetter,
        'idioma_id' =>  $idioma->idioma_id,
    ];
});
