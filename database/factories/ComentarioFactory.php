<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comentario;
use Faker\Generator as Faker;

$factory->define(Comentario::class, function (Faker $faker) {

    return [
        'item_id' => $faker->randomDigitNotNull,
        'programacao_id' => $faker->randomDigitNotNull,
        'comentario' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
