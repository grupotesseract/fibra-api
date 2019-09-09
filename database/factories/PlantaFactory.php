<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Cidade;
use App\Models\Planta;
use App\Models\Empresa;
use Faker\Generator as Faker;

$factory->define(Planta::class, function (Faker $faker) {
    return [
        'nome' => $faker->catchPhrase,
        'endereco' => $faker->address,
        'cidade_id' => Cidade::inRandomOrder()->first()->id,
        'empresa_id' => Empresa::inRandomOrder()->first()->id,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
