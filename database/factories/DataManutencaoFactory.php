<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\DataManutencao;
use Faker\Generator as Faker;

$factory->define(DataManutencao::class, function (Faker $faker) {

    return [
        'programacao_id' => $faker->randomDigitNotNull,
        'item_id' => $faker->randomDigitNotNull,
        'data_inicio' => $faker->date('Y-m-d H:i:s'),
        'data_fim' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
