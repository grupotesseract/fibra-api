<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Item;
use App\Models\ItemAlterado;
use App\Models\Material;
use App\Models\Programacao;
use Faker\Generator as Faker;

$factory->define(ItemAlterado::class, function (Faker $faker) {
    return [
        'programacao_id' => Programacao::inRandomOrder()->get()->first()->id,
        'item_id' => Item::inRandomOrder()->get()->first()->id,
        'material_id' => Material::inRandomOrder()->get()->first()->id,
        'quantidade_instalada' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
