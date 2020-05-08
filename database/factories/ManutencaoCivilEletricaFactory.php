<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ManutencaoCivilEletrica;
use App\Models\Planta;
use Faker\Generator as Faker;

$factory->define(ManutencaoCivilEletrica::class, function (Faker $faker) {
    return [
        'problemas_encontrados' => $faker->text,
        'informacoes_adicionais' => $faker->text,
        'observacoes' => $faker->text,
        'it' => $faker->text,
        'os' => $faker->text,
        'lem' => $faker->text,
        'let' => $faker->text,
        'obra_atividade' => $faker->word,
        'equipe_cliente' => $faker->name,
        'data_hora_entrada' => \Carbon\Carbon::parse($faker->date('Y-m-d H:i:s')),
        'data_hora_saida' => \Carbon\Carbon::parse($faker->date('Y-m-d H:i:s')),
        'data_hora_inicio_lem' => \Carbon\Carbon::parse($faker->date('Y-m-d H:i:s')),
        'data_hora_final_lem' => \Carbon\Carbon::parse($faker->date('Y-m-d H:i:s')),
        'data_hora_inicio_let' => \Carbon\Carbon::parse($faker->date('Y-m-d H:i:s')),
        'data_hora_final_let' => \Carbon\Carbon::parse($faker->date('Y-m-d H:i:s')),
        'data_hora_inicio_atividades' => \Carbon\Carbon::parse($faker->date('Y-m-d H:i:s')),
        'planta_id' => Planta::inRandomOrder()->first()->id,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
