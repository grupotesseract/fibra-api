<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Planta;
use Faker\Generator as Faker;

$factory->define(Planta::class, function (Faker $faker) {

    return [
        'nome' => $faker->word,
        'endereco' => $faker->word,
        'cidade_id' => $faker->randomDigitNotNull,
        'empresa_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
