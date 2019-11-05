<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Material;
use App\Models\Planta;
use App\Models\QuantidadeMinima;
use Faker\Generator as Faker;

$factory->define(QuantidadeMinima::class, function (Faker $faker) {
    return [
        'material_id' => Material::inRandomOrder()->first()->id,
        'planta_id' => Planta::inRandomOrder()->first()->id,
        'quantidade_minima' => $faker->numberBetween($min = 50, $max = 100),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
