<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ItemAlterado;
use Faker\Generator as Faker;

$factory->define(ItemAlterado::class, function (Faker $faker) {

    return [
        'programacao_id' => $faker->randomDigitNotNull,
        'item_id' => $faker->randomDigitNotNull,
        'material_id' => $faker->randomDigitNotNull,
        'quantidade_instalada' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
