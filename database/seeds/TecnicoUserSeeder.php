<?php

use Illuminate\Database\Seeder;

class TecnicoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userAdmin = factory(\App\Models\Usuario::class)->create([
            'login' => env('ADMIN_EMAIL', 'fvlimafernandes'),
            'email' => env('ADMIN_EMAIL', null),
            'password' => bcrypt(env('ADMIN_PASSWORD', '12344321')),
            'passwordsha256' => hash('sha256', env('ADMIN_PASSWORD', '12344321')),
            'nome' => 'Fernando Lima Fernandes',
            'cidade_id' => \App\Models\Cidade::where('nome', 'Bauru')->first()->id,
        ]);
        $userAdmin->attachRole(\App\Models\Role::ROLE_TECNICO);

        $userAdmin = factory(\App\Models\Usuario::class)->create([
            'login' => env('ADMIN_EMAIL', 'evandro.carreira'),
            'email' => env('ADMIN_EMAIL', null),
            'password' => bcrypt(env('ADMIN_PASSWORD', '12344321')),
            'passwordsha256' => hash('sha256', env('ADMIN_PASSWORD', '12344321')),
            'nome' => 'Evandro Carreira',
            'cidade_id' => \App\Models\Cidade::where('nome', 'Bauru')->first()->id,
        ]);
        $userAdmin->attachRole(\App\Models\Role::ROLE_TECNICO);

        $userAdmin = factory(\App\Models\Usuario::class)->create([
            'login' => env('ADMIN_EMAIL', 'renato.gomes'),
            'email' => env('ADMIN_EMAIL', null),
            'password' => bcrypt(env('ADMIN_PASSWORD', '12344321')),
            'passwordsha256' => hash('sha256', env('ADMIN_PASSWORD', '12344321')),
            'nome' => 'Renato Gomes',
            'cidade_id' => \App\Models\Cidade::where('nome', 'Bauru')->first()->id,
        ]);
        $userAdmin->attachRole(\App\Models\Role::ROLE_TECNICO);
    }
}
