<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Usuario;
use App\Models\LiberacaoDocumento;
use Faker\Generator as Faker;
use App\Models\UsuarioLiberacao;

$factory->define(UsuarioLiberacao::class, function (Faker $faker) {
    return [
        'liberacao_documento_id' => LiberacaoDocumento::inRandomOrder()->first()->id,
        'usuario_id' => Usuario::inRandomOrder()->first()->id,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
