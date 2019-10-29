<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\EntradaMaterial;
use App\Models\Material;
use App\Models\Programacao;
use Faker\Generator as Faker;

$factory->define(EntradaMaterial::class, function (Faker $faker) {

    return [
        'material_id' => Material::inRandomOrder()->first()->id,
        'programacao_id' => Programacao::inRandomOrder()->first()->id,
        'quantidade' => $faker->numberBetween(0, 100),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
