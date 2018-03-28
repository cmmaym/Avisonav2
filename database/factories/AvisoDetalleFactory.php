<?php

use Faker\Generator as Faker;

$factory->define(AvisoNavAPI\AvisoDetalle::class, function (Faker $faker) {
    return [
        'observacion'   => $faker->paragraph,
        'aviso_id'  => $faker->randomDigit,
        'tipo_caracter_id' => 1,
        'tipo_aviso_id' => 1,
        'idioma_id'     => 1
    ];
});
