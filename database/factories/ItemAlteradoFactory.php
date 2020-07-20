<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Item;
use App\Models\ItemAlterado;
use App\Models\Material;
use App\Models\Programacao;
use Faker\Generator as Faker;

$factory->define(ItemAlterado::class, function (Faker $faker) {
    $programacao = Programacao::inRandomOrder()->get()->first();
    $planta = $programacao->planta;
    $item = $planta->itens()->inRandomOrder()->get()->first();

    return [
        'programacao_id' => $programacao->id,
        'item_id' => $item->id,
        'material_id' => Material::inRandomOrder()->get()->first()->id,
        'quantidade_instalada' => $faker->randomDigitNotNull,
        'quantidade_base' => $faker->randomDigitNotNull,
        'quantidade_reator' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
