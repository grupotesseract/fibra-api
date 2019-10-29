<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\EntradaMaterial;
use Faker\Generator as Faker;

$factory->define(EntradaMaterial::class, function (Faker $faker) {

    return [
        'material_id' => $faker->randomDigitNotNull,
        'programacao_id' => $faker->randomDigitNotNull,
        'quantidade' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
