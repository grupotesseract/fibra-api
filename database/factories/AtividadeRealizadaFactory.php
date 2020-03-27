<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\AtividadeRealizada;
use App\Models\ManutencaoCivilEletrica;
use Faker\Generator as Faker;

$factory->define(AtividadeRealizada::class, function (Faker $faker) {

    return [
        'texto' => $faker->word,
        'status' => $faker->boolean,
        'manutencao_id' => ManutencaoCivilEletrica::inRandomOrder()->first()->id,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
