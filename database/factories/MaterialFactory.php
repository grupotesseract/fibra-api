<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Material;
use App\Models\TipoMaterial;
use Faker\Generator as Faker;

$factory->define(Material::class, function (Faker $faker) {
    return [
        'nome' => $faker->word,
        'potencia' => $faker->randomNumber($nbDigits = 3),
        'tensao' => $faker->randomNumber($nbDigits = 3),
        'tipo_material_id' => TipoMaterial::inRandomOrder()->first()->id,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
