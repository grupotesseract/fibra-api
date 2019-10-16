<?php

use Illuminate\Database\Seeder;

class QuantidadesMinimasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Programacao::class, 100)->create();
    }
}
