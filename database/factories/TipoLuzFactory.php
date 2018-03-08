<?php

use AvisoNavAPI\Idioma;
use Faker\Generator as Faker;

$factory->define(AvisoNavAPI\TipoLuz::class, function (Faker $faker) {

    $idioma = Idioma::all()->first();
    
    return [
        'clase'         => $faker->word,
        'alias'         => $faker->word,
        'descripcion'   => $faker->sentence(),
        'cod_ide'       => $faker->randomLetter,
        'idioma_id'     => $idioma->idioma_id,
    ];
});
