<?php

use Illuminate\Database\Seeder;

class AtividadesRealizadasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\AtividadeRealizada::class, 20)->create();
    }
}
