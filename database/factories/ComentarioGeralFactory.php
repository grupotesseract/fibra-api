<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ComentarioGeral;
use Faker\Generator as Faker;

$factory->define(ComentarioGeral::class, function (Faker $faker) {

    return [
        'programacao_id' => $faker->randomDigitNotNull,
        'comentario' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
