<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ManutencaoCivilEletrica;
use Faker\Generator as Faker;

$factory->define(ManutencaoCivilEletrica::class, function (Faker $faker) {

    return [
        'data_hora_entrada' => $faker->date('Y-m-d H:i:s'),
        'data_hora_saida' => $faker->date('Y-m-d H:i:s'),
        'data_hora_inicio_lem' => $faker->date('Y-m-d H:i:s'),
        'data_hora_final_lem' => $faker->date('Y-m-d H:i:s'),
        'data_hora_inicio_let' => $faker->date('Y-m-d H:i:s'),
        'data_hora_final_let' => $faker->date('Y-m-d H:i:s'),
        'data_hora_inicio_atividades' => $faker->date('Y-m-d H:i:s'),
        'planta_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
