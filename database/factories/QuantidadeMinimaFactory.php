<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\QuantidadeMinima;
use Faker\Generator as Faker;

$factory->define(QuantidadeMinima::class, function (Faker $faker) {

    return [
        'material_id' => $faker->randomDigitNotNull,
        'planta_id' => $faker->randomDigitNotNull,
        'quantidade_minima' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
