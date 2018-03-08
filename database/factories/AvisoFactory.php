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
        'fecha'         => $faker->dateTimeBetween($startDate = '-2 years'),
        'observacion'   => $faker->paragraph,
        'periodo'       => $faker->unique->year,
        'entidad_id'    => $entidad->entidad_id,
        'tipo_carac_id' => $tipoCaracter->tipo_carac_id,
        'tipo_aviso_id' => $tipoAviso->tipo_aviso_id,
        'idioma_id'     => 1,
        'carta_id'      => $carta->carta_id,
        'user_id'       => 1,
        'created_at'     => '2018-03-08 15:00:00'
    ];
});
