<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Cidade;
use App\Models\Empresa;
use Faker\Generator as Faker;

$factory->define(Empresa::class, function (Faker $faker) {
    return [
        'nome' => $faker->company,
        'email' => $faker->email,
        'telefone' => $faker->phoneNumber,
        'path_imagem' => 'https://res.cloudinary.com/api-fibra/image/upload/v1594812013/logos/WhatsApp_Image_2020-07-14_at_15.59.55_bglevd.jpg',
        'endereco' => $faker->address,
        'cidade_id' => Cidade::inRandomOrder()->first()->id,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
