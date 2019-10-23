<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Estoque;
use App\Models\Material;
use App\Models\Programacao;
use Faker\Generator as Faker;

$factory->define(Estoque::class, function (Faker $faker) {
    $qntInicial = $faker->numberBetween(0, 50);
    return [
        'material_id' => Material::inRandomOrder()->first()->id,
        'programacao_id' => Programacao::inRandomOrder()->first()->id,
        'quantidade_inicial' => $qntInicial,
        'quantidade_final' => $faker->numberBetween(0, $qntInicial),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
