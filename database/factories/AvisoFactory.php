<?php

use AvisoNavAPI\Carta;
use AvisoNavAPI\Entidad;
use AvisoNavAPI\TipoAviso;
use Faker\Generator as Faker;
use AvisoNavAPI\TipoCaracter;

$factory->define(AvisoNavAPI\Aviso::class, function (Faker $faker) {

    $entidad        = Entidad::all()->random();
    $tipoCaracter   = TipoCaracter::all()->random();
    $tipoAviso      = TipoAviso::all()->random();
    $carta          = Carta::all()->random();
    
    return [
        'num_aviso'     => $faker->randomDigit,
        'fecha'         => $faker->dateTimeBetween($startDate = '-1 days'),
        'observacion'   => $faker->paragraph,
        'periodo'       => $faker->unique->year,
        'entidad_id'    => 1,
        'tipo_carac_id' => 1,
        'tipo_aviso_id' => 1,
        'idioma_id'     => 1,
        'carta_id'      => 1,
        'user_id'       => 1,
    ];
});
