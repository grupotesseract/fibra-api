<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ManutencaoCivilEletrica;
use App\Models\Usuario;
use App\Models\UsuarioManutencao;
use Faker\Generator as Faker;

$factory->define(UsuarioManutencao::class, function (Faker $faker) {
    return [
        'manutencao_id' => ManutencaoCivilEletrica::inRandomOrder()->first()->id,
        'usuario_id' => Usuario::inRandomOrder()->first()->id,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
