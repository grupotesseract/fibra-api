<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\TipoMaterial;
use Faker\Generator as Faker;

$factory->define(TipoMaterial::class, function (Faker $faker) {
    $tipo = $faker->randomElement(['Lâmpada', 'Reator']);

    return [
        'nome' => $faker->word,
        'abreviacao' => $faker->text(5),
        'tipo' => $faker->randomElement(['Lâmpada', 'Reator']),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
