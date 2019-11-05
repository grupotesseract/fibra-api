<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\LiberacaoDocumento;
use App\Models\Programacao;
use Faker\Generator as Faker;

$factory->define(LiberacaoDocumento::class, function (Faker $faker) {
    return [
        'programacao_id' => Programacao::inRandomOrder()->first()->id,
        'data_hora' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
