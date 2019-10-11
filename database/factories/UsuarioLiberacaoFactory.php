<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UsuarioLiberacao;
use Faker\Generator as Faker;

$factory->define(UsuarioLiberacao::class, function (Faker $faker) {

    return [
        'liberacao_documento_id' => $faker->randomDigitNotNull,
        'usuario_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
