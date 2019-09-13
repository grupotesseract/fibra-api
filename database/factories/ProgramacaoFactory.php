<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Programacao;
use Faker\Generator as Faker;

$factory->define(Programacao::class, function (Faker $faker) {

    return [
        'data_inicio_prevista' => $faker->date('Y-m-d H:i:s'),
        'data_fim_prevista' => $faker->date('Y-m-d H:i:s'),
        'data_inicio_real' => $faker->date('Y-m-d H:i:s'),
        'data_fim_real' => $faker->date('Y-m-d H:i:s'),
        'planta_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
