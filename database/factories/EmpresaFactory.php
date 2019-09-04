<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Empresa;
use App\Models\Cidade;
use Faker\Generator as Faker;

$factory->define(Empresa::class, function (Faker $faker) {
    return [
        'nome' => $faker->company,
        'email' => $faker->email,
        'telefone' => $faker->phoneNumber,
        'endereco' => $faker->address,
        'cidade_id' => Cidade::inRandomOrder()->first()->id,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
