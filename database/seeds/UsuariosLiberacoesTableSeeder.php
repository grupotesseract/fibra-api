<?php

use Illuminate\Database\Seeder;

class UsuariosLiberacoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\UsuarioLiberacao::class, 20)->create();
    }
}
