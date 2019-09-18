<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Potencia;
use Faker\Generator as Faker;

$factory->define(Potencia::class, function (Faker $faker) {

    return [
        'valor' => $faker->numberBetween($min = 50, $max = 100),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
