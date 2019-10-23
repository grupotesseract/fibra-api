<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Item;
use App\Models\Material;
use App\Models\Programacao;
use Faker\Generator as Faker;
use App\Models\QuantidadeSubstituida;

$factory->define(QuantidadeSubstituida::class, function (Faker $faker) {
    return [
        'programacao_id' => Programacao::inRandomOrder()->first()->id,
        'item_id' => Item::inRandomOrder()->first()->id,
        'material_id' => Material::inRandomOrder()->first()->id,
        'quantidade_substituida' => $faker->numberBetween($min = 50, $max = 100),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
