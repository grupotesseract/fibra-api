<?php

use Illuminate\Database\Seeder;

class UsuariosManutencoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\UsuarioManutencao::class, 20)->create();
    }
}
