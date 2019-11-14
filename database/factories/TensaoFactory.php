<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Tensao;
use Faker\Generator as Faker;

$factory->define(Tensao::class, function (Faker $faker) {
    return [
        'valor' => $faker->unique()->numberBetween($min = 50, $max = 100),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
