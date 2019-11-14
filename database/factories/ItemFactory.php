<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Item;
use App\Models\Planta;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'nome' => $faker->sentence,
        'qrcode' => 'FIBRA-'.$faker->unique()->randomNumber(4),
        'circuito' => $faker->randomElement(['Normal', 'Emergência']),
        'planta_id' => Planta::inRandomOrder()->first()->id,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
