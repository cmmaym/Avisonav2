<?php

use AvisoNavAPI\Idioma;
use Faker\Generator as Faker;

$factory->define(AvisoNavAPI\TipoCaracter::class, function (Faker $faker) {
    
    $idioma = Idioma::all()->first();

    return [
        'nombre'    => $faker->jobtitle,
        'cod_ide'   => $faker->randomLetter,
        'idioma_id' => $idioma->idioma_id,
    ];
});
