<?php

use Illuminate\Database\Seeder;

class ManutencoesCivilEletricaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ManutencaoCivilEletrica::class, 100)->create();
    }
}
